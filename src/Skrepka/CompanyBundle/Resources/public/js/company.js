$(function(){
    $("#company_category").children("optgroup[label=not_show]").remove();
    $("#company_category").children("optgroup[label=not_show]").children().remove();
    $("#company_category").select2();
    $("#company_city").select2();
    $('.tip').tooltip();
})

