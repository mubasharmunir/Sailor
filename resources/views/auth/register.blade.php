<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Validation Errors -->
      <x-auth-validation-errors class="mb-4" :errors="$errors" />
      <!-- Sign up form -->
      <section class="signup">
          <div class="container">
              <div class="signup-content">
                  <div class="signup-form">
                      <h2 class="form-title">Register Now</h2>
                      <form method="POST" action="{{ route('register') }}">
                        @csrf
                      <form method="POST" class="register-form" id="register-form">
                          <div class="form-group">
                              <!-- Name -->
                            <label for="name" :value="__('Name')"><i class="zmdi zmdi-account material-icons-name"></i></label>
                              <input type="text" name="name" id="name" :value="old('name')" required autofocus />
                          </div>

                          <!-- Email Address -->

                          <div class="form-group">
                            <label for="email" :value="__('Email')"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email" :value="old('email')" required />
                        </div>

            <!-- Password -->

            <div class="form-group">
                <label for="password" :value="__('Password')"><i class="zmdi zmdi-lock"></i></label>
                <input type="password" name="password" id="password" required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->

            <div class="form-group">
                <label for="password_confirmation" :value="__('Confirm Password')"><i class="zmdi zmdi-lock-outline"></i></label>
                <input type="password" name="password_confirmation" id="password_confirmation" required />
            </div>

                <div class="form-group form-button">
                    <input type="submit" name="signup" id="signup" class="form-submit" value={{ __('Register')}}/>
                </div>

                {{-- <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button> --}}
            </div>
            <div class="signup-image">
                <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                <a href="{{ route('login') }}" class="signup-image-link">I am already member</a>
            </div>
        </div>
    </div>
</section>
{{--
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a> --}}

        </form>
    </body>
   <!-- JS -->
   <script src="vendor/jquery/jquery.min.js"></script>
   <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
