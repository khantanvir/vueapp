import { ref } from "vue"
import axios from "axios";
import { useRouter } from 'vue-router';
export default function Service() {

	let getUrl = 'http://localhost/vueapp/';
	// getStr(str = null,len = null) {
	//   if (str === null && len === null) {
	//     return false;
	//   }
	//   if (str.length > 70) {
	//     var result = str.substring(0, len)+'...';
	//     return result;
	//   }
	//   return str;
	// }
	// //date function
	// getDate(str=null){
	// 	if (str === null) {
	//     return false;
	//   }
	//   var date = new Date(str * 1000);
	//   var result = date.toUTCString();
	//   return result;
	// }
	// isBST(date) {
	//   var d = date || new Date();
	//   var starts = lastSunday(2, d.getFullYear());
	//   starts.setHours(1);
	//   var ends = lastSunday(9, d.getFullYear());
	//   starts.setHours(1);
	//   return d.getTime() >= starts.getTime() && d.getTime() < ends.getTime();
	// }
	// setCookie(cname,cvalue,exdays) {
	// 	  const d = new Date();
	// 	  d.setTime(d.getTime() + (exdays*24*60*60*1000));
	// 	  let expires = "expires=" + d.toGMTString();
	// 	  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	// 	}
	// eraseCookie(cname) {
    //     var d = new Date(); //Create an date object
    //     d.setTime(d.getTime() - (1000*60*60*24)); //Set the time to the past. 1000 milliseonds = 1 second
    //     var expires = "expires=" + d.toGMTString(); //Compose the expirartion date
    //     window.document.cookie = cname+"="+"; "+expires;//Set the cookie with name and the expiration date
    // }
	return{
		getUrl,
	}
	
}