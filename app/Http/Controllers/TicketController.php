<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\PayeeStep1Request;
use App\Models\Payee;
use App\Models\Ticket;
use App\Http\Requests\TicketRequest;
use App\Models\Redlep;

class TicketController extends Controller
{
    public function index(){

    }
    public function create_ticket(TicketRequest $request){
        $ticket = new Ticket();
        $ticket->subject = $request->input('subject');
        $ticket->company_id = $request->input('company_id');
        $ticket->category_id = $request->input('category_id');
        $ticket->priority = $request->input('priority');
        $ticket->message = $request->input('message');
        //image upload
        //main image resize and upload
        if($request->hasFile('image')){
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $filename = $image->getClientOriginalName();
            $filename = rand(1000,100000).'.'.$ext;
            $image->move('public/ticket/',$filename);
            // $image_resize = Image::make($image->getRealPath());
            // $image_resize->resize(538,435);
            // $image_resize->save(public_path('assets/blog/main/' .$filename));
            $ticket->image = $filename;
        }
        //create url
        //create url code
        $url_modify = Redlep::slug_create($ticket->subject);
        $checkSlug = Ticket::where('url','LIKE','%'.$url_modify.'%')->count();
        if($checkSlug > 0){
            $new_number = $checkSlug + 1;
            $new_slug = $url_modify.'-'.$new_number;
            $ticket->url = $new_slug;
        }else{
            $ticket->url = $url_modify;
        }
        $ticket->create_by = 1;
        $ticket->create_date = time();
        $ticket->is_view = 0;
        $ticket->status = 0;
        $ticket->deleted_at = 0;
        $ticket->save();
        $data['result'] = array(
            'key' => '200',
            'val'=> $ticket
        );
        return response()->json($data,200);
        
    }
    //
    public function is_view_ticket($url=NULL){
        if(empty($url)){
            $data['result'] = array(
                'key'=>101,
                'val'=>'Url not found!'
            );
            return response()->json($data,200);
        }
        $getTicket = Ticket::where('url',$url)->first();
        if(empty($getTicket)){
            $data['result'] = array(
                'key'=>101,
                'val'=>'Ticket data not found!'
            );
            return response()->json($data,200);
        }
        $view = Ticket::where('id',$getTicket->id)->update(['reciever_id'=>1,'is_view'=>1]);
        $data['result'] = array(
            'key'=>200,
            'val'=>'Ticket recieved by super admin!'
        );
        return response()->json($data,200);
    }
    //send message by super admin
    public function ticket_message(Request $request){
        //check auth
        $msg = array();
        $msg[] = array(
            'id'=>1,//auto increment
            'ticket_id'=>1,
            'sender_id'=>1,
            'date'=>time(),
            'reply_id'=>2,
            'message'=>'I check this error hope it will work'
        );
        //check message array exists or not 
        $ticket_id = $request->input('ticket_id');
        $getTicket = Ticket::where('id',$ticket_id)->first();
        if(empty($getTicket)){
            $data['result'] = array(
                'key'=>101,
                'val'=>'Ticket Data Not Found!'
            );
            return response()->json($data,200);
        }
        if(!empty($getTicket->discussion)){
            $getMessage = json_decode($getTicket->discussion);
            //check is array and get last id of array
            if(is_array($getMessage)){
                $msg[] = array(
                    'id'=>2,//auto increment
                    'ticket_id'=>1,
                    'sender_id'=>0,
                    'date'=>time(),
                    'reply_id'=>4,
                    'message'=>$request->input('message'),
                );
                $datamerge = array_merge($getMessage,$msg);
                $update = Ticket::where('id',$getTicket->id)->update(['discussion'=>$datamerge]);
                $data['result'] = array(
                    'key'=>200,
                    'val'=>$msg,
                    'message'=>'message sent!'
                );
                return response()->json($data,200);
            }
        }else{
            $msg[] = array(
                'id'=>1,//auto increment
                'ticket_id'=>1,
                'sender_id'=>1,
                'date'=>time(),
                'reply_id'=>0,
                'message'=>$request->input('message'),
            );
            $msgData = json_encode($msg);
            $update = Ticket::where('id',$getTicket->id)->update(['discussion'=>$msgData]);
            $data['result'] = array(
                'key'=>200,
                'val'=>$msgData,
                'message'=>'message sent!'
            );
            return response()->json($data,200);
        }
    }
}
