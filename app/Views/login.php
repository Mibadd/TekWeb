<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login / Signup</title>
   <link rel="stylesheet" href="<?= base_url('css/style.css'); ?>">
   <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>
<body>
   <header class="header">
      <nav class="nav">
         <a href="#" class="nav_logo">Motorku</a>
         <ul class="nav_items">
            <li class="nav_item">
               <a href="#" class="nav_link">Home</a>
               <a href="#" class="nav_link">Product</a>
               <a href="#" class="nav_link">Services</a>
               <a href="#" class="nav_link">Contact</a>
            </li>
         </ul>
         <button class="button" id="form-open" aria-label="Open Login/Signup Form">Login</button>
      </nav>
   </header>

   <!-- Home Section -->
   <div class="home">
      <!-- Form Container (Login/Signup) -->
      <div class="form_container" aria-hidden="true">
         <!-- Close Button -->
         <button class="form_close" aria-label="Close Form">&times;</button>

         <!-- Signup Form -->
         <div class="form signup_form">
            <form action="<?= base_url('auth/signup_post'); ?>" method="POST">
               <h2>Signup</h2>
               <?php if (session()->getFlashdata('error')): ?>
                  <p style="color: red;" aria-live="polite"><?= session()->getFlashdata('error'); ?></p>
               <?php endif; ?>
               <div class="input_box">
                  <input type="text" name="name" placeholder="Enter your name" required aria-label="Name">
                  <i class="uil uil-user"></i>
               </div>
               <div class="input_box">
                  <input type="email" name="email" placeholder="Enter your email" required aria-label="Email">
                  <i class="uil uil-envelope-alt"></i>
               </div>
               <div class="input_box">
                  <input type="password" name="password" placeholder="Enter your password" required aria-label="Password">
                  <i class="uil uil-lock"></i>
                  <i class="uil uil-eye-slash pw_hide" aria-label="Toggle Password Visibility"></i>
               </div>
               <div class="option_field">
                  <span class="checkbox">
                     <input type="checkbox" id="check" required aria-label="Agree to Terms">
                     <label for="check">I agree to the terms and conditions</label>
                  </span>
               </div>
               <button class="button">Signup Now</button>
               <div class="login_signup">Already have an account? <a href="#" id="login">Login</a></div>
            </form>
         </div>

         <!-- Login Form -->
         <div class="form login_form">
            <form action="<?= base_url('auth/login_post'); ?>" method="POST">
               <h2>Login</h2>
               <?php if (session()->getFlashdata('error')): ?>
                  <p style="color: red;" aria-live="polite"><?= session()->getFlashdata('error'); ?></p>
               <?php endif; ?>
               <div class="input_box">
                  <input type="email" name="email" placeholder="Enter your email" required aria-label="Email">
                  <i class="uil uil-envelope-alt"></i>
               </div>
               <div class="input_box">
                  <input type="password" name="password" placeholder="Enter your password" required aria-label="Password">
                  <i class="uil uil-lock"></i>
                  <i class="uil uil-eye-slash pw_hide" aria-label="Toggle Password Visibility"></i>
               </div>
               <button class="button">Login Now</button>
               <div class="login_signup">Don't have an account? <a href="#" id="signup">Signup</a></div>
            </form>
         </div>
      </div>
   </div>

   <script src="<?= base_url('js/script.js'); ?>"></script>
</body>
</html>
