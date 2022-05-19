# Laravel Jquery Ajax Validation plugin.
## Simple & clean plugin(Script) for laravel ajax validations.

This is a very simple plugin for laravel “blade” validations used for laravel “request” validations.

Few rules to keep in mind before you start working on it.

- Invalid inputs are using bootstrap “.in-valid” classes by default. However, you may use “Tailwind” and its classes as needed.
- For ajax requests and DOM manipulation, I have used jquery to make it simple for me :)
- HTML input name attribute should be the same as you are using for validation requests in your controller or request file.

### How to add validations to your laravel blade?

Step 1:
Add bootstrap-5 and Jquery CDN in your app.blade.php file probably on top of your head tag.
```html
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/js/validation.js') }}"></script> 
  {{-- This is custome js file you will find that in this project "public/assets/js/validation.js" directory. --}}
```
Step 2:
Give form a “id” and “action” attribute which will help you validate form.
Step 3:
Now add the bellow script to bottom of your form which I have created.
```html
<script>
        $(document).ready(function() {
            let validateFormId = 'loginUser';
            $(`#${validateFormId}`).on('submit', function(e) {
                e.preventDefault();
                validateFormFields({
                    formID: validateFormId
                }, this);
            })
        });
    </script>
```
Note: “validateFormFields()” is a function and it needs an object to customize it. you can pass several parameters as the needed list is given below.
```javascript
    { 
        formID,
        buttonId, // submit button id, it'll take submit by default
        url, // where you want to post data, add manually or it'll take from form action
        afterSuccessRedirectUrl, // add route after success redirect.
        successMessage, // for toaster use
        errorMessage, // for toaster use 
        loader, // pass custom html for loading button
        resetForm // by default it's true after successfull response form will get reset as before.
    }
```
For a better understanding of these objects, You can find uses in the validation.js file as referred above.

##### And DONE!!!
You are ready with your form validation now you can use this in any laravel blade form.
