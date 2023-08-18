
function checkValueddate(id) {
    var lastDate =parseInt($('#degree_diploma_year_'+id).val());
    var did=id-1;
    var old=parseInt($('#degree_diploma_year_'+did).val());
    if(lastDate < old || lastDate == old ){
       $('#diploma_year_' + id).html('Year of Passing not be lese  ');
    }else{
       $('#diploma_year_' + id).html('');
    }
}
function ValidateFromdate(id) {

    var fromdate = $('#work_experience_from_' + id).val();
    var todate = $('#work_experience_to_' + id).val();
  
    var Fromdate = new Date(fromdate);
    var Todate = new Date(todate);
    
    $(".work_experience_From_error_" + id).html("");
    $(".work_experience_to_error_" + id).html("");
 
    if (Fromdate > Todate || Fromdate == Todate) {
        // alert("from");
        // $("#work_experience_from_"+id).val("");
        $(".work_experience_From_error_" + id).html("From Date Should Be Less Than To Date").addClass("error-msg");
        return false;
    }
    var did=id-1;
   
    var old= $('#work_experience_to_' + did).val();
    
    var Todateold = new Date(old);
    if(Date.parse(Fromdate) < Todateold || Date.parse(Fromdate) == Todateold){
       
       $('.work_experience_From_error_' + id).html('Please Enter next years').addClass("error-msg");
    }
}

function ValidateTodate(id) {

    var fromdate = $('#work_experience_from_' + id).val();
    var todate = $('#work_experience_to_' + id).val();
        //alert(fromdate);
    var Fromdate = new Date(fromdate);
    var Todate = new Date(todate);
    $(".work_experience_From_error_" + id).html("");
    $(".work_experience_to_error_" + id).html("");
    if (Fromdate > Todate) {

        $(".work_experience_to_error_" + id).html("To Date Should Be Greater Than From Date").addClass("error-msg");
        return false;
    }
}

jQuery(function(){
    var dtToday = new Date();

    var month = dtToday.getMonth() + 1;// jan=0; feb=1 .......
    var day = dtToday.getDate();
    var year = dtToday.getFullYear() - 19;
   
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
      var minDate = year + '-' + month + '-' + day;
   // var minDate = day + '-' + month + '-' + year;
     var maxDate = year + '-' + month + '-' + day;
    //var maxDate = day + '-' + month + '-' + year;
   
    jQuery('#dob').attr('max', maxDate);

});


function SubmitForm() {

    var identity_proof = $('input[name="identity_proof"]:checked').val();
    var identity_number = $('#identity_number').val();
    if (identity_proof == 'DL') {
        isValid_License_Number(identity_number);
    }
    if (identity_proof == 'Adhaar') {
        ValidateAadhaar(identity_number);
    }
    if (identity_proof == 'Pan') {
        ValidatePAN(identity_number);
    }
    if (identity_proof == 'Passport') {
        isValidPassportNo(identity_number);
    }
    if (identity_proof == 'Voter') {
        isValidEPICNumber(identity_number);
    }
    var categorys = $('#categorys').val();
    var category_name = $('.category_name').val();
   // alert(category_name);
    if (categorys == 1) {
        
        if(category_name){
            $('.category_name_error').html('The Category  field is required.');
        }else{
            $('.category_name_error').html('');  
        }
        
        $('.cat_doc_error').html('The Category Attachment field is required.');
    }else{
        $('.cat_doc_error').html(''); 
        $('.category_name_error').html('');
    }
      
}
var categorys = $('#categorys').val();
if (categorys == 1) {
    document.getElementById('a1').style.display = "block"
} else if (categorys == 2) {
    document.getElementById('a1').style.display = "none"
}

var benchmark_yes = $('#benchmark_yes').val();
if (benchmark_yes == true) {
    document.getElementById('a2').style.display = "block"
} else {
    document.getElementById('a2').style.display = "none"
}