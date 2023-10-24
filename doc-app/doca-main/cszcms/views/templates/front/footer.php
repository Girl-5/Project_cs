<script src="<?php echo base_url('assets/front/') ?>js/script.js"></script>
<div class="container">
<div id="google_translate_element"></div>
</div>


<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>
</html>

<style>
    /* The alert message box */
.alert {
  padding: 20px;
  background-color: #4CAF50; /* Red */
  color: white;
  margin-bottom: 15px;
}

/* The close button */
.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

/* When moving the mouse over the close button */
.closebtn:hover {
  color: black;
}
</style>

<script>
// ==========FOR THIRD DIV =============================
function check_eligibility_third(){
    var total = 0;
    $(":radio:checked").each(function(){
        total += Number(this.value);
    });
    if(total > 0){
        $(".eligibility_next_third").css("pointer-events", "auto");
    }else{
        $(".eligibility_next_third").css("pointer-events", "none");
    }
}

// ============FOR SECOND DIV ==================
function check_eligibility_second(){
    var total = 0;
    $(":radio:checked").each(function(){
        total += Number(this.value);
    });
    if(total > 0){
        $(".eligibility_next_second").css("pointer-events", "auto");
    }else{
        $(".eligibility_next_second").css("pointer-events", "none");
    }
}

$(".eligibility_next_second").click(function(){
     $(".second_section").hide();
     $(".third_section").show();
});


// ==============FOR FIST DIV ===================
 function check_eligibility_first(){
    var total = 0;
    $(":radio:checked").each(function(){
        total += Number(this.value);
    });
    if(total == 3){
        $(".eligibility_next_first").css("pointer-events", "auto");
    }else{
        $(".eligibility_next_first").css("pointer-events", "none");
    }
}

$(".eligibility_next_first").click(function(){
     $(".first_section").hide();
     $(".second_section").show();
});
    
</script>