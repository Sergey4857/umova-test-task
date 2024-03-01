<?php
/* Template Name: Home page */

get_header();
?>
<section class="form-container">
    <div class="form-content">
        <h1>Reach Out and <span>Connect</span> With Us</h1>
        <div class="form-text">Bridging Your Ideas with Our Expertise</div>
        <form action="<?php echo admin_url("admin-ajax.php") ?>" class="contact-form">
            <input type="hidden" name="action" value="my_action">
            <input type="text" name="name" class="contact-name" placeholder="Name *">
            <div id="name-error" class="error-message"></div>

            <input type="email" name="email" class="contact-mail" placeholder="E-mail *">
            <div id="email-error" class="error-message"></div>

            <input type="text" name="number" class="contact-phone" placeholder="Phone *">
            <div id="phone-error" class="error-message"></div>

            <div class="password-block">
                <input type="password" name="password" placeholder="Password *" class="contact-password">
                <div class="show-password">
                    <img class="eye-icon-closed" src=<?php echo get_template_directory_uri() . "./src/icons/eye-closed.svg" ?> alt="Show Password" />
                    <img class="eye-icon-opened" src=<?php echo get_template_directory_uri() . "./src/icons/eye-opened.svg" ?> alt="Show Password" />
                </div>

            </div>
            <div id="password-error" class="error-message"></div>

            <div class="city-block">
                <select class="city" name="city">
                    <option value="">Choose your city</option>
                    <option value="city1">New Jersey</option>
                    <option value="city2">New Mexico</option>
                    <option value="city3">New York</option>
                </select>
            </div>
            <div id="city-error" class="error-message"></div>

            <div class="wrap">
                <div class="custom-checkbox">
                    <input type="checkbox" id="privacy" name="privacy">
                    <label for="privacy">I have read and accepted <a href="#">privacy policy</a></label>
                </div>
                <button type="submit">Submit</button>
            </div>
            <div id="privacy-error" class="error-message"></div>
        </form>


    </div>
</section>


<?php get_footer(); ?>