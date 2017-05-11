$(document).ready(function() {

    // Password Meter
    var passwordMeterSettings = {};
    passwordMeterSettings.ui = {
        container: "#pwd-container",
        showVerdictsInsideProgressBar: true,
        viewports: {
            progress: ".pwstrength_viewport_progress"
        }
    };
    passwordMeterSettings.common = {
        zxcvbn: true,
        userInputs: ['#name', '#email', '#first_name', '#last_name']
    };
    $('.passwordMeter').pwstrength(passwordMeterSettings);

});
