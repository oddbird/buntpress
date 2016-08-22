<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package buntpress
 */

?>

  </main><!-- #content -->

  <div class="footer">
    <footer data-region="footer">
      <div class="copyright">
        <?php buntpress_do_copyright_text(); ?>
      </div>

      <!--Begin CTCT Sign-Up Form-->
      <!-- EFD 1.0.0 [Sun Aug 21 16:21:40 EDT 2016] -->
      <div class="ctct-embed-signup email-signup">
        <h4 class="email-header">Sign Up for our Guest List</h4>
        <p class="email-intro">Get emails about upcoming events and opportunities.</p>
        <div id="success_message" style="display:none;">
          Thanks for signing up!
        </div>
        <form data-id="embedded_signup:form" class="ctct-custom-form Form" name="embedded_signup" method="POST" action="https://visitor2.constantcontact.com/api/signup">
          <!-- The following code must be included to ensure your sign-up form works properly. -->
          <input data-id="ca:input" type="hidden" name="ca" value="dd72d72c-deba-41cb-981a-3b16def3f3dc">
          <input data-id="list:input" type="hidden" name="list" value="7">
          <input data-id="source:input" type="hidden" name="source" value="EFD">
          <input data-id="required:input" type="hidden" name="required" value="list,email">
          <input data-id="url:input" type="hidden" name="url" value="">
          <div data-id="Email Address:p" >
            <label data-id="Email Address:label" data-name="email" class="ctct-form-required screen-reader-text">Email Address</label>
            <input data-id="Email Address:input" type="text" name="email" value="" maxlength="80" placeholder="email@example.com">
          </div>
          <div class="form-actions">
            <button type="submit" class="ctct-button btn" data-enabled="enabled">Sign Up</button>
          </div>
        </form>
      </div>
      <script type='text/javascript'>
        var localizedErrMap = {};
        localizedErrMap['required'] =    'This field is required.';
        localizedErrMap['ca'] =      'An unexpected error occurred while attempting to send email.';
        localizedErrMap['email'] =       'Please enter your email address in name@email.com format.';
        localizedErrMap['birthday'] =    'Please enter birthday in MM/DD format.';
        localizedErrMap['anniversary'] =   'Please enter anniversary in MM/DD/YYYY format.';
        localizedErrMap['custom_date'] =   'Please enter this date in MM/DD/YYYY format.';
        localizedErrMap['list'] =      'Please select at least one email list.';
        localizedErrMap['generic'] =     'This field is invalid.';
        localizedErrMap['shared'] =    'Sorry, we could not complete your sign-up. Please contact us to resolve this.';
        localizedErrMap['state_mismatch'] = 'Mismatched State/Province and Country.';
        localizedErrMap['state_province'] = 'Select a state/province';
        localizedErrMap['selectcountry'] =   'Select a country';
        var postURL = 'https://visitor2.constantcontact.com/api/signup';
      </script>
      <script type='text/javascript' src='https://static.ctctcdn.com/h/contacts-embedded-signup-assets/1.0.2/js/signup-form.js'></script>
      <!--End CTCT Sign-Up Form-->

    </footer>
  </div>

  <?php wp_footer(); ?>

</body>
</html>
