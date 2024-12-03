 function validate(){

 var profile = document.register.profile.value;
 var reference = document.register.reference.value;
 var surname = document.register.surname.value;
 var firstname = document.register.firstname.value;
 var gender = document.register.gender.selectedIndex;
 var dob = document.register.dob.value;
 var mothertongue = document.register.mothertongue.value;
 var nationality = document.register.nationality.value;
 var email = document.register.email.value;
 var mobile = document.register.mobile.value;
 var terms = document.register.terms.value;

 var mail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
 var phone = /^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$/

 if(profile == ""){
 alert("Please Select ProfileCreatedBy");
     return false;
     }
else if(reference == ""){
 alert("Please Select ReferenceBy");
 return false;
              }

              
else if(surname == ""){
 alert("Please Enter Surname");
 return false;
              }
             
 else if(!surname.match(/^[A-za-z]+$/))
     {
  alert("Please Enter Alphabets only");
         return false;
         }
 else if(firstname == ""){
 alert("Please Enter FirstName");
 return false;
              }
             
 else if(!firstname.match(/^[A-za-z\s]+$/))
     {
  alert("Please Enter Alphabets only");
         return false;
         }                           
 
 else if((register.gender[0].checked == false)&&(register.gender[1].checked == false)){
     alert("please selcet gender");
    return false;
     }
     
 else if((register.maritalstatus[0].checked == false)&&(register.maritalstatus[1].checked == false)&&(register.maritalstatus[2].checked == false)&&(register.maritalstatus[3].checked == false)){
     alert("please selcet maritalstatus");
    return false;
     }           
 else if(dob == ""){
 alert("Please Enter Date Of Birth");
 return false;
              }    
              
 else if(mothertongue == ""){
 alert("Please Select MotherTongue");
 return false;    
 }

else if(nationality == ""){
    alert("Please Select Nationality");
    return false;
}
 else if(mobile == ""){
    alert("Please Enter MobileNumber");
    return false;
}
else if(!mobile.match(phone)){
 alert("Please Enter Valid Mobile Number");
  return false;
              }
else if(email == ""){
    alert("Please Enter Email");
    return false;
}
 else if(!email.match(mail)){
 alert("Please enter Valid Email");
  return false;
              }

else if(register.terms.checked == false){
    alert("Please Agree Terms and conditions");
	return false;
}                           
return true;
        
        }
        
        
function requiredvalidate(){
    
    var looking = document.getElementsByName('looking[]'); 
    var countryfor = document.requiredform.countryfor.value;
    var countryfor = document.requiredform.countryfor.value;
    var agefrom = document.requiredform.agefrom.value;
    var ageto = document.requiredform.ageto.value;
    var feetfor = document.requiredform.feetfor.value;
    var feetto = document.requiredform.feetto.value;
    var cmplxionfor = document.requiredform.cmplxionfor.value;
    var education = document.requiredform.selectedIndex;
    var occupation = document.requiredform.selectedIndex ;
    hascheck = false;
    for (var i=0; i<looking.length; i++){
        if(looking[i].checked){
            hascheck = true;
            break;
            }
        }    
    if(hascheck == false){
        alert("please select the you are looking for");
        return false;
    }
    else if(countryfor==""){
        alert("Please select country ")
        return false;
    }
    else if(agefrom ==""){
        alert("please slect age from");
        return false;
    }
    else if(ageto ==""){
        alert("Please select ageto")
            return false;
        }
    else if(agefrom > ageto){
        alert("from age should be lessthan to age");
        return false;
    } 
   else if(feetfor==''){
       alert("please select height from");
       return false;
   } 
   else if(feetto == ''){
           alert("please slect height to");
           return false;
   }
   else if(cmplxionfor ==""){
       alert("Please select cmplexion");
   }
   else if((requiredform.education[0].checked == false)&&(requiredform.education[1].checked == false)){
     alert("please selcet education");
    return false;
     }
     else if((requiredform.occupation[0].checked == false)&&(requiredform.occupation[1].checked == false)&&(requiredform.occupation[2].checked == false)){
         alert("please select ocupation");
         return false;
     }
    return true;
}        
