<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Signup</title>
   <link rel="stylesheet" href="<?= base_url('css/style.css'); ?>" />
   <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
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
      </nav>
   </header>

   <section class="home">
      <div class="form_container">
         <i class="uil uil-times form_close"></i>
         <div class="form signup_form">
            <form action="<?= base_url('auth/signup_post'); ?>" method="POST">
               <h2>Signup</h2>
               <?php if (session()->getFlashdata('error')): ?>
                  <p style="color: red;"><?= session()->getFlashdata('error'); ?></p>
               <?php endif; ?>
               <div class="input_box">
                  <input type="text" name="name" placeholder="Enter your name" required />
                  <i class="uil uil-user"></i>
               </div>
               <div class="input_box">
                  <input type="email" name="email" placeholder="Enter your email" required />
                  <i class="uil uil-envelope-alt email"></i>
               </div>
               <div class="input_box">
                  <input type="password" name="password" placeholder="Enter your password" required />
                  <i class="uil uil-lock password"></i>
                  <i class="uil uil-eye-slash pw_hide"></i>
               </div>
               <button class="button">Signup Now</button>
               <div class="login_signup">Already have an account? <a href="<?= base_url('auth/login'); ?>" id="login">Login</a></div>
            </form>
         </div>
      </div>
   </section>

   <script src="<?= base_url('js/script.js'); ?>"></script>
</body>
</html>
