function validateFormFields(formDetails, currentForm) {
    const {
        formID,
        buttonId, // submit button id, it'll take submit by default
        url, // where you want to post data, add manually or it'll take from form action
        afterSuccessRedirectUrl, // add route after success redirect.
        successMessage, // for toaster use
        errorMessage, // for toaster use 
        loader, // pass custom html for loading button
        resetForm
    } = formDetails;
    if (!formID) {
        console.error("FormId is required");
        return;
    }

    const buttonLoader = loader ||
        `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`
    const buttonText = $(`#${formID} :submit`)[0].innerHTML;
    let submitButton = buttonId ? `#${buttonId}` : $(`#${formID} :submit`)[0];

    const ajaxUrl = url || $(this).attr('action');

    const formData = new FormData(currentForm);
    // console.log("formData", formData);
    $.ajax({
        url: url,
        method: "POST",
        beforeSend: () => {
            $(submitButton).attr('disabled', true).text('Loading ').append(buttonLoader);
        },
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: (data) => {
            if (!!data.redirect || !!afterSuccessRedirectUrl) {
                let redirectTo = data.redirect ? data.redirect : afterSuccessRedirectUrl;
                setTimeout(function() {
                    window.location.href = redirectTo;
                }, 0);
            }
            $(`#${formID}`)[0].reset();
            printErrorMsg(null);
        },
        error: (xhr) => {
            $("textarea, input").removeClass("is-invalid");
            $(".invalid-feedback").remove();
            errors = xhr.responseJSON.errors;
            printErrorMsg(errors);
            $(submitButton).attr('disabled', false).text(buttonText);
        },
        complete: () => {
            $(submitButton).attr('disabled', false).text(buttonText);
        }
    });
};

function printErrorMsg(errors = null, formID = '') {
    $("textarea, input").removeClass("is-invalid");
    $(".invalid-feedback").remove();
    const formId = formID ? '' : `#${formID} `;
    let index = 0;
    $.each(errors, function(key, value) {
        let inputs = $(`${formID} [name="${key}"]`);
        if (index == 0) {
            inputs.focus();
        }
        if (inputs.is(':checkbox') || inputs.is(':radio')) {
            inputs.addClass('is-invalid');
            inputs.parent().append(`<div class="invalid-feedback">${value[0]}</div>`)
        } else {
            inputs.addClass('is-invalid').after(`<div class="invalid-feedback">${value[0]}</div>`);
        }
        index++;
    });
}