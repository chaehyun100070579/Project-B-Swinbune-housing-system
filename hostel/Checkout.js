function unCheckAll(field)
{
    for (i = 0; i < field.length; i++)
    {   field[i].checked = false;
    }
}

function disabledAll(field)
{
    for (i = 0; i < field.length; i++)
    {   field[i].style.background="transparent";
     field[i].disabled = true;
    }
}

function enabledAll(field)
{
    for (i = 0; i < field.length; i++)
    {   field[i].disabled = false;
     field[i].style.background="#FFFFAA";
    }
}

function getLocation(option,field)
{
    unCheckAll(field);
    field[option-1].checked = true;
    document.CheckoutForm.Location_field.value = field[option-1].value;
}

function getCheckout(option,field)
{
    unCheckAll(field);
    field[option-1].checked = true;
    document.CheckoutForm.Checkout_field.value = field[option-1].value;	

    if (option==1)
    {	
        document.CheckoutForm.Bank_Swift_Code.disabled == false;

        document.CheckoutForm.Refund_Deposit.disabled = true;
        document.CheckoutForm.Refund_Others.disabled = true;
        document.CheckoutForm.RefundDetail.disabled = true;

        document.CheckoutForm.Refund_MOP.disabled = true;
        disabledAll(document.CheckoutForm.Refund_MOP);	    
        document.CheckoutForm.TT_Currency.disabled = true;
        document.CheckoutForm.Cheque.disabled = true;    

        document.CheckoutForm.NewAddress.disabled = true;
        document.CheckoutForm.OwnerName.disabled = true;
        document.CheckoutForm.OwnerContact.disabled = true;	

        document.CheckoutForm.Agree_Refund_Term.disabled = false;
    }

    if (option==2)
    {	
        document.CheckoutForm.Cheque.disabled = true;
        document.CheckoutForm.Refund_Deposit.disabled = false;
        document.CheckoutForm.Refund_Deposit.style.background="#FFFFAA";
        document.CheckoutForm.Refund_Others.disabled = false;
        document.CheckoutForm.Refund_Others.style.background="#FFFFAA";
        document.CheckoutForm.RefundDetail.disabled = false;
        document.CheckoutForm.RefundDetail.style.background="#FFFFAA";
        enabledAll(document.CheckoutForm.Refund_MOP);	
        enabledAll(document.CheckoutForm.Refund_Bank_FName);
        document.CheckoutForm.Agree_Refund_Term.disabled = false;
        document.CheckoutForm.Agree_Refund_Term.style.background="#FFFFAA";   

        document.CheckoutForm.NewAddress.disabled = true;
        document.CheckoutForm.OwnerName.disabled = true;
        document.CheckoutForm.OwnerContact.disabled = true;	
    }

    if ( option==3)
    {	
        document.CheckoutForm.Cheque.disabled = false;
        document.CheckoutForm.Refund_Deposit.disabled = false;
        document.CheckoutForm.Refund_Deposit.style.background="#FFFFAA";
        document.CheckoutForm.Refund_Others.disabled = false;
        document.CheckoutForm.Refund_Others.style.background="#FFFFAA";
        document.CheckoutForm.RefundDetail.disabled = false;
        document.CheckoutForm.RefundDetail.style.background="#FFFFAA";
        enabledAll(document.CheckoutForm.Refund_MOP);	
        enabledAll(document.CheckoutForm.Refund_Bank_FName);
        document.CheckoutForm.Agree_Refund_Term.disabled = false;
        document.CheckoutForm.Agree_Refund_Term.style.background="#FFFFAA"; 

        document.CheckoutForm.NewAddress.disabled = true;
        document.CheckoutForm.OwnerName.disabled = true;
        document.CheckoutForm.OwnerContact.disabled = true;	
    }

    if (option==4)
    {	   
        document.CheckoutForm.Cheque.disabled = true;
        document.CheckoutForm.Refund_Deposit.disabled = false;
        document.CheckoutForm.Refund_Deposit.style.background="#FFFFAA";
        document.CheckoutForm.Refund_Others.disabled = false;
        document.CheckoutForm.Refund_Others.style.background="#FFFFAA";
        document.CheckoutForm.RefundDetail.disabled = false;
        document.CheckoutForm.RefundDetail.style.background="#FFFFAA";
        enabledAll(document.CheckoutForm.Refund_MOP);	
        //enabledAll(document.CheckoutForm.Refund_Bank_FName);
        document.CheckoutForm.Bank_AcctNo.disabled = false;
        document.CheckoutForm.Bank_Name.disabled = false;
        document.CheckoutForm.Bank_Address.disabled = false;
        document.CheckoutForm.Agree_Refund_Term.disabled = false;
        document.CheckoutForm.Agree_Refund_Term.style.background="#FFFFAA";    

        document.CheckoutForm.NewAddress.disabled = false;
        document.CheckoutForm.OwnerName.disabled = false;
        document.CheckoutForm.OwnerContact.disabled = false;

    }


}

function getRefund_Bank_FName(option,field)
{
    unCheckAll(field);
    field[option-1].checked = true;
    document.CheckoutForm.Refund_Name_field.value = field[option-1].value;
    if (document.CheckoutForm.Refund_Name_field.value=='Payee Name')
    {   document.CheckoutForm.Bank_FullName.disabled = false;
     document.CheckoutForm.Bank_FullName.focus();
     document.CheckoutForm.Bank_ParentName.value = '';
     document.CheckoutForm.Bank_ParentName.style.background="transparent";
     document.CheckoutForm.Bank_ParentName.disabled = true;
    }
    else
    {   document.CheckoutForm.Bank_ParentName.disabled = false;
     document.CheckoutForm.Bank_ParentName.focus();
     document.CheckoutForm.Bank_FullName.value = '';
     document.CheckoutForm.Bank_FullName.style.background="transparent";
     document.CheckoutForm.Bank_FullName.disabled = true;
    }
}

function getRefund_MOP(option,field)
{
    unCheckAll(field);
    field[option-1].checked = true;
    document.CheckoutForm.Refund_MOP_field.value = field[option-1].value;
    if (document.CheckoutForm.Refund_MOP_field.value=='Direct Bank In')
    {	document.CheckoutForm.TT_Currency.value = '';
     document.CheckoutForm.TT_Currency.style.background="transparent";
     document.CheckoutForm.TT_Currency.disabled = true;		
     document.CheckoutForm.Payee_ID.disabled = false;
     document.CheckoutForm.Payee_ID.style.background="#FFFFAA";
     document.CheckoutForm.Bank_AcctNo.disabled = false;
     document.CheckoutForm.Bank_AcctNo.style.background="#FFFFAA";
     document.CheckoutForm.Bank_Name.disabled = false;
     document.CheckoutForm.Bank_Name.style.background="#FFFFAA";
     document.CheckoutForm.Bank_Address.disabled = false;
     document.CheckoutForm.Bank_Address.style.background="#FFFFAA";
     document.CheckoutForm.Bank_Town.disabled = false;
     document.CheckoutForm.Bank_Town.style.background="#FFFFAA";
     document.CheckoutForm.Bank_Swift_Code.value = '';
     document.CheckoutForm.Bank_Swift_Code.style.background="transparent";
     document.CheckoutForm.Bank_Swift_Code.disabled = false;
    }  
    else
    {	document.CheckoutForm.TT_Currency.disabled = false;
     document.CheckoutForm.TT_Currency.focus();
     document.CheckoutForm.Payee_ID.disabled = false;
     document.CheckoutForm.Payee_ID.style.background="#FFFFAA";
     document.CheckoutForm.Bank_AcctNo.disabled = false;
     document.CheckoutForm.Bank_AcctNo.style.background="#FFFFAA";
     document.CheckoutForm.Bank_Name.disabled = false;
     document.CheckoutForm.Bank_Name.style.background="#FFFFAA";
     document.CheckoutForm.Bank_Address.disabled = false;
     document.CheckoutForm.Bank_Address.style.background="#FFFFAA";
     document.CheckoutForm.Bank_Town.disabled = false;
     document.CheckoutForm.Bank_Town.style.background="#FFFFAA";
     document.CheckoutForm.Bank_Swift_Code.disabled = false;
     document.CheckoutForm.Bank_Swift_Code.style.background="#FFFFAA";
    }
}

function filterNonNumeric(field)
{
    var result = new String();
    var numbers = "0123456789";
    var chars = field.value.split(""); // create array 
    for (i = 0; i < chars.length; i++)
    {	if (numbers.indexOf(chars[i]) != -1) result += chars[i];
    }
    if (field.value != result) field.value = result;
}

function filterNonContactNo(field)
{
    var result = new String();
    var numbers_symbol = "0123456789-,;";
    var chars = field.value.split(""); // create array 
    for (i = 0; i < chars.length; i++)
    {	if (numbers_symbol.indexOf(chars[i]) != -1) result += chars[i];
    }
    if (field.value != result) field.value = result;
}

function changeInColor(thefield)
{
    thefield.style.background="#BBFFBB";
} 

function changeColorBack(thefield)
{
    thefield.style.background="#FFFFAA";
}

//function displayStudEmail(field)
//{   var studID = field.value.toLowerCase();
//    document.CheckoutForm.Email.value = studID + '@student.curtin.edu.my';
//}

function emailCheck (emailStr)
{
    /* The following variable tells the rest of the function whether or not to verify that the address ends in a two-letter country or well-known TLD.  1 means check it, 0 means don't. */
    var checkTLD=1;

    /* The following is the list of known TLDs that an e-mail address must end with. */
    var knownDomsPat=/^(cc|com|net|org|edu|int|mil|gov|arpa|biz|aero|name|coop|info|pro|museum)$/;

    /* The following pattern is used to check if the entered e-mail address fits the user@domain format. It also is used to separate the username from the domain. */
    var emailPat=/^(.+)@(.+)$/;

    /* The following string represents the pattern for matching all special characters.  We don't want to allow special characters in the address. These characters include ( ) < > @ , ; : \ " . [ ] */
    var specialChars="\\(\\)><@,;:\\\\\\\"\\.\\[\\]";

    /* The following string represents the range of characters allowed in a username or domainname.  It really states which chars aren't allowed.*/
    var validChars="\[^\\s" + specialChars + "\]";

    /* The following pattern applies if the "user" is a quoted string (in which case, there are no rules about which characters are allowed and which aren't; anything goes).  E.g. "jiminy cricket"@disney.com is a legal e-mail address. */
    var quotedUser="(\"[^\"]*\")";

    /* The following pattern applies for domains that are IP addresses, rather than symbolic names.  E.g. joe@[123.124.233.4] is a legal e-mail address. NOTE: The square brackets are required. */
    var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/;

    /* The following string represents an atom (basically a series of non-special characters.) */
    var atom=validChars + '+';

    /* The following string represents one word in the typical username. For example, in john.doe@somewhere.com, john and doe are words. Basically, a word is either an atom or quoted string. */
    var word="(" + atom + "|" + quotedUser + ")";

    /* The following pattern describes the structure of the user */
    var userPat=new RegExp("^" + word + "(\\." + word + ")*$");

    /* The following pattern describes the structure of a normal symbolic domain, as opposed to ipDomainPat, shown above. */
    var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$");

    /* Finally, let's start trying to figure out if the supplied address is valid. */
    /* Begin with the coarse pattern to simply break up user@domain into different pieces that are easy to analyze. */
    var matchArray=emailStr.match(emailPat);

    if (matchArray==null) 
    {   /* Too many/few @'s or something; basically, this address doesn't even fit the general mould of a valid e-mail address. */
        alert("Email address seems incorrect (please check @ and .)");
        return false;
    }

    var user=matchArray[1];
    var domain=matchArray[2];

    /* Start by checking that only basic ASCII characters are in the strings (0-127). */
    for (i=0; i<user.length; i++)
    {   if (user.charCodeAt(i)>127) 
    {   alert("Ths email address contains invalid characters.");
     return false;
    }
    }

    for (i=0; i<domain.length; i++) 
    {   if (domain.charCodeAt(i)>127)
    {   alert("Ths email address contains invalid characters.");
     return false;
    }
    }

    /* See if "user" is valid */
    if (user.match(userPat)==null)
    {   /* user is not valid */
        alert("The username doesn't seem to be valid.");
        return false;
    }

    /* if the e-mail address is at an IP address (as opposed to a symbolic host name) make sure the IP address is valid. */
    var IPArray=domain.match(ipDomainPat);
    if (IPArray!=null)
    {   /* this is an IP address */
        for (var i=1;i<=4;i++)
        {   if (IPArray[i]>255)
        {   alert("Destination IP address is invalid!");
         return false;
        }
        }
        return true;
    }

    /* Domain is symbolic name.  Check if it's valid. */
    var atomPat=new RegExp("^" + atom + "$");
    var domArr=domain.split(".");
    var len=domArr.length;
    for (i=0;i<len;i++)
    {   if (domArr[i].search(atomPat)==-1)
    {   alert("The email address does not seem to be valid, please check.");
     return false;
    }
    }

    /* domain name seems valid, but now make sure that it ends in a known top-level domain (like com, edu, gov) or a two-letter word, representing country (uk, nl), and that there's a hostname preceding the domain or country. */
    if (checkTLD && domArr[domArr.length-1].length!=2 && domArr[domArr.length-1].search(knownDomsPat)==-1)
    {   alert("The email address does not seem to be valid, please check.");
     return false;
    }

    /* Make sure there's a host name preceding the domain. */
    if (len<2)
    {   alert("The email address does not seem to be valid, please check.");
     return false;
    }

    /* If we've gotten this far, everything's valid! */
    return true;
}

function checkEmpty()
{
    var pass=true;
    var empty=true;

    if (document.CheckoutForm.Bed.value=='')
    {   alert('You MUST fill in your Bed Condition.');
     document.CheckoutForm.Bed.focus();
     pass=false;
     return false;
    }

    if (document.CheckoutForm.CheckinDate.value=='')
    {   alert('You MUST fill in your CheckinDate.');
     document.CheckoutForm.CheckinDate.focus();
     pass=false;
     return false;
    }



    if (document.CheckoutForm.FullName.value=='')
    {   alert('You MUST fill in your NAME.');
     document.CheckoutForm.FullName.focus();
     pass=false;
     return false;
    }

    if (document.CheckoutForm.StudID.value=='')
    {   alert('You MUST fill in your STUDENT ID.');
     document.CheckoutForm.StudID.focus();
     pass=false;
     return false;
    }

    if (document.CheckoutForm.ContactNo.value=='')
    {   alert('You MUST fill in your CONTACT NO.');
     document.CheckoutForm.ContactNo.focus();
     pass=false;
     return false;
    }

    if (document.CheckoutForm.Email.value=='')
    {   alert('You MUST fill in your E-MAIL.');
     document.CheckoutForm.Email.focus();
     pass=false;
     return false;
    }
    else
    {   if (emailCheck(document.CheckoutForm.Email.value)==false)
    {   document.CheckoutForm.Email.focus();
     pass=false;
     return false;
    } 
    }

    if (document.CheckoutForm.Location_field.value=='')
    {   alert('You MUST fill in your Buildings.');
     document.CheckoutForm.Location[0].focus();
     pass=false;
     return false;
    }

    if (document.CheckoutForm.House_Flat.value=='')
    {   alert('You MUST fill in the HOUSE / FLAT.');
     document.CheckoutForm.House_Flat.focus();
     pass=false;
     return false;
    }

    if (document.CheckoutForm.RoomNo.value=='')
    {   alert('You MUST fill in the ROOM NO.');
     document.CheckoutForm.RoomNo.focus();
     pass=false;
     return false;
    }

    if (document.CheckoutForm.TenancyEnd.value=='')
    {   alert('You MUST fill in your TENANCY END DATE.');
     document.CheckoutForm.TenancyEnd.focus();
     pass=false;
     return false;
    }
    else
    {   var today = new Date();
     var todayDate = today.getFullYear() + (today.getMonth() < 9 ? '0' : '') + (today.getMonth() + 1) + (today.getDate() < 10 ? '0' : '') + today.getDate();
     var dateSelect = document.CheckoutForm.TenancyEnd.value;
     var selectDay = dateSelect.substring(0,2);
     var selectMonth = dateSelect.substring(3,5);
     var selectYear = dateSelect.substring(6,10);
     var dateSelectStr = selectYear + selectMonth + selectDay;
     difference = dateSelectStr - todayDate;
     if (difference < 0)
     {   alert('The selected TENANCY END DATE has past, please choose another date.');
      pass=false;
      return false;
     } 
    }

    if (document.CheckoutForm.Checkout_field.value=='')
    {   alert('You MUST select a CHECK OUT option.');
     document.CheckoutForm.Checkout[0].focus();
     pass=false;
     return false;
    }

    if (document.CheckoutForm.Checkout[3].checked==true)
    {   
        if (document.CheckoutForm.NewAddress.value=='')
        {     
            alert('You MUST enter your new address.');
            document.CheckoutForm.NewAddress.focus();
            pass=false;
            return false;
        }

        if (document.CheckoutForm.OwnerName.value=='')
        {     
            alert('You MUST enter the Owner Name.');
            document.CheckoutForm.OwnerName.focus();
            pass=false;
            return false;
        }

        if (document.CheckoutForm.OwnerContact.value=='')
        {     
            alert('You MUST enter the Owner Contact.');
            document.CheckoutForm.OwnerContact.focus();
            pass=false;
            return false;
        }

    }

    if (document.CheckoutForm.CheckoutReason.value=='')
    {   alert('You MUST fill in the CHECK OUT REASON.');
     document.CheckoutForm.CheckoutReason.focus();
     pass=false;
     return false;
    }

    if ((document.CheckoutForm.Refund_Deposit.checked==true) || (document.CheckoutForm.Refund_Others.checked==true))
    {
        if ((document.CheckoutForm.Refund_Others.checked==true) && (document.CheckoutForm.RefundDetail.value==''))
        {   alert('You MUST state details for the OTHERS REFUND.');
         document.CheckoutForm.RefundDetail.focus();
         pass=false;
         return false;
        }

        if ((document.CheckoutForm.Refund_MOP[0].disabled==false) && (document.CheckoutForm.Refund_MOP_field.value==''))
        {   alert('You MUST select a MODE OF PAYMENT option.');
         document.CheckoutForm.Refund_MOP[0].focus();
         pass=false;
         return false;
        }

        if ((document.CheckoutForm.TT_Currency.disabled==false) && (document.CheckoutForm.TT_Currency.value==''))
        {   alert('You MUST specify the T/T currency.');
         document.CheckoutForm.TT_Currency.focus();
         pass=false;
         return false;
        }

        if ((document.CheckoutForm.Refund_Bank_FName[0].disabled==false) && (document.CheckoutForm.Refund_Name_field.value==''))
        {   alert('You MUST select a REFUND PAYEE option.');
         document.CheckoutForm.Refund_Bank_FName[0].focus();
         pass=false;
         return false;
        }

        if ((document.CheckoutForm.Refund_Bank_FName[0].checked==true) && (document.CheckoutForm.Bank_FullName.value==''))
        {  alert('You MUST fill in the PAYEE NAME as stated in your bank book.');
         document.CheckoutForm.Bank_FullName.focus();
         pass=false;
         return false;
        }

        if ((document.CheckoutForm.Refund_Bank_FName[1].checked==true) && (document.CheckoutForm.Bank_ParentName.value==''))
        {   alert('You MUST fill in the PAYEE NAME as stated in your bank book.');
         document.CheckoutForm.Bank_ParentName.focus();
         pass=false;
         return false;
        }

        if ((document.CheckoutForm.Payee_ID.disabled==false) && (document.CheckoutForm.Payee_ID.value==''))
        {   alert('You MUST fill in the Payee\'s IC or Passport No.');
         document.CheckoutForm.Payee_ID.focus();
         pass=false;
         return false;
        }

        if ((document.CheckoutForm.Bank_AcctNo.disabled==false) && (document.CheckoutForm.Bank_AcctNo.value==''))
        {   alert('You MUST fill in the BANK ACCOUNT NO.');
         document.CheckoutForm.Bank_AcctNo.focus();
         pass=false;
         return false;
        }

        if ((document.CheckoutForm.Bank_Name.disabled==false) && (document.CheckoutForm.Bank_Name.value==''))
        {   alert('You MUST fill in the BANK NAME.');
         document.CheckoutForm.Bank_Name.focus();
         pass=false;
         return false;
        }

        if ((document.CheckoutForm.Bank_Address.disabled==false) && (document.CheckoutForm.Bank_Address.value==''))
        {   alert('You MUST fill in the BANK ADDRESS.');
         document.CheckoutForm.Bank_Address.focus();
         pass=false;
         return false;
        }

        if ((document.CheckoutForm.Bank_Town.disabled==false) && (document.CheckoutForm.Bank_Town.value==''))
        {   alert('You MUST fill in the Bank TOWN / CITY.');
         document.CheckoutForm.Bank_Town.focus();
         pass=false;
         return false;
        }

        if ((document.CheckoutForm.Bank_Swift_Code.disabled==false) && (document.CheckoutForm.Bank_Swift_Code.value==''))
        {   alert('You MUST fill in the BANK SWIFT CODE.');
         document.CheckoutForm.Bank_Swift_Code.focus();
         pass=false;
         return false;
        }

        if ((document.CheckoutForm.Agree_Refund_Term.disabled==false) && (document.CheckoutForm.Agree_Refund_Term.checked==false))
        {   alert('You MUST Agree to the Refund Terms and Conditions.');
         document.CheckoutForm.Agree_Refund_Term.focus();
         pass=false;
         return false;
        }
    }

    if (document.CheckoutForm.CheckoutDate.value=='')
    {	alert('You MUST fill in your CHECK OUT / DEPARTURE DATE.');
     document.CheckoutForm.CheckoutDate.focus();
     pass=false;
     return false;
    }
    else
    {	var today = new Date();
     var todayDate = today.getFullYear() + (today.getMonth() < 9 ? '0' : '') + (today.getMonth() + 1) + (today.getDate() < 10 ? '0' : '') + today.getDate();
     var dateSelect = document.CheckoutForm.CheckoutDate.value;
     var selectDay = dateSelect.substring(0,2);
     var selectMonth = dateSelect.substring(3,5);
     var selectYear = dateSelect.substring(6,10);
     var dateSelectStr = selectYear + selectMonth + selectDay;
     difference = dateSelectStr - todayDate;
     if (difference < 0)
     {   alert('The selected CHECK OUT / DEPARTURE DATE has past, please choose another date.');
      pass=false;
      return false;
     } 
    }

    if (document.CheckoutForm.CheckoutTime.value=='')
    {	alert('You MUST fill in your CHECK OUT TIME.');
     document.CheckoutForm.CheckoutTime.focus();
     pass=false;
     return false;
    }

    if (!pass)
        return false;
    else
        return true;
}

//  End -->