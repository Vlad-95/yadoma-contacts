$(document).ready(function() {
    $('#client_phone').inputmask('+7 (999) 999-99-99');
});

const steps = $('.quiz__form-step');
const nextStep = $('.js-next');
const prevStep = $('.js-prev');
const percentIndicator = $('.quiz__footer-progress-bar-item');
const percent = $('.quiz__footer-progress-text');
let percentNumb = $('.quiz__footer-progress-text span');
let stepCounter = 0;
let stepPercent = 0;


const clickNextStep = function (evt) {
    evt.preventDefault;
    stepCounter++;    
    steps.removeClass('quiz__form-step--active');
    $(steps[stepCounter]).addClass('quiz__form-step--active');
    prevStep.fadeIn();

    stepPercent += 50;
    percentNumb.text(stepPercent + '%');
    
    $(percentIndicator[stepCounter - 1]).addClass('active');
    
    if (stepCounter >= 2) {
        $('.quiz__wrap').addClass('last-steps');
        $('.quiz__bottom').addClass('active');
    }

    $('body,html').animate({
        scrollTop: 0
    }, 500);
    
}

const clickPrevStep = function(evt) {
    evt.preventDefault;
    stepCounter--;
    steps.removeClass('quiz__form-step--active');
    $(steps[stepCounter]).addClass('quiz__form-step--active');

    if (stepCounter === 0) {
        prevStep.fadeOut();
    }

    stepPercent -= 50;
    percentNumb.text(stepPercent + '%');

    $(percentIndicator[stepCounter]).removeClass('active');

    if (stepCounter < 2) {
        $('.quiz__wrap').removeClass('last-steps');
        $('.quiz__bottom').removeClass('active');
    }
    
    $('body,html').animate({
        scrollTop: 0
    }, 500);
}

nextStep.click(clickNextStep);
prevStep.click(clickPrevStep);

// появление номера поддержки на десктопе
$('.quiz__help').click(function(evt) {
    if(window.innerWidth > 992) {
        evt.preventDefault();
        $('.quiz__help-number').fadeIn();
    }
    
})
