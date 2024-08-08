$(document).ready(function() {
    var currentStep = 1;

    function showStep(step) {
        $('.form-step').removeClass('active');
        $('#formStep' + step).addClass('active');
        $('.step').removeClass('active');
        $('#step' + step).addClass('active');
    }

    $('#nextStep1').click(function() {
        currentStep = 2;
        showStep(currentStep);
    });

    $('#nextStep2').click(function() {
        currentStep = 3;
        showStep(currentStep);
    });

    $('#prevStep2').click(function() {
        currentStep = 1;
        showStep(currentStep);
    });

    $('#prevStep3').click(function() {
        currentStep = 2;
        showStep(currentStep);
    });
});
