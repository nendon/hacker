$(document).ready(function () {
    var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content');


    allWells.removeClass('active');

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
                $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            allWells.removeClass('active');
            $target.addClass('active');
            $target.find('input:eq(0)').focus();
        }

        if($('#step-1').hasClass('active')){
            $('.modal-footer').hide();
        }else{
            $('.modal-footer').show();
        }
    });

    $('#prevBtn').click(function(){
        var curStep = $('.setup-content.active').attr("id");
            
        $('div.setup-panel div a[href="#' + curStep + '"]').parent().prev().children("a").trigger('click');

        $('#classBtn').hide();
        $('#nextBtn').show();

        if($('#step-1').hasClass('active')){
            $('.modal-footer').hide();
        }
    });

    $('#nextBtn, .nextBtn').click(function(){
        var curStep = $('.setup-content.active'),
        curStepBtn = curStep.attr("id"),
        nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
        curInputs = curStep.find("input[type='text'],input[type='url']"),
        isValid = true;

        //Form Validation
        $(".form-group").removeClass("has-error");
        for(var i=0; i<curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }
        if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');

        $('.modal-footer').show();
        if($('#step-3').hasClass('active')){
            $('#nextBtn').hide();
            $('#classBtn').show();
        }
    });


    $('div.setup-panel div a.btn-primary').trigger('click');

});