<?php $ip = $_SERVER['HTTP_CLIENT_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['HTTP_X_REAL_IP'] ?? $_SERVER['REMOTE_ADDR'] ?>

<div id="FormContainer" class="FormContainer">
  <h3>Fill out the form below or call us at <a href="tel:+17188410025">718-841-0025</a>
    for a consultation.</h3>
  <form action="https://bailynlaw.com/mailer/create-email" method="post">
    <table border="0" bgcolor="#000" cellspacing="5" align="center">
      <div class="form-group">
        <tr><td></td><td><input class="form-control rounded-0 header-quote-input-field" type="text" size="30" name="name" placeholder="Name:"></td></tr>
      </div>

      <div class="form-group">
        <tr><td></td><td><input class="form-control rounded-0 header-quote-input-field" type="text" size="30" name="number" placeholder="Phone Number:"></td></tr>
      </div>
      <div class="form-group">
        <tr><td></td><td><input class="form-control rounded-0 header-quote-input-field" type="text" size="30" name="email" placeholder="Email:"></td></tr>
      </div>
      <div class="form-group">
        <tr><td valign="top"></td><td><textarea class="form-control rounded-0 header-quote-input-field" name="comments" size="30" rows="6" cols="30" placeholder="Brief summary of the facts..."></textarea></td></tr>
      </div>
      <div class="form-group">
        <tr><td valign="top"></td><td><input name="ip" type="hidden" value="<?php echo "$ip" ?>"></input></td></tr>
      </div>
      <tr><td>&nbsp;</td><td><input type="submit" value="Send" class="btn btn-info rounded-0"></td></tr>
    </table>
  </form>
</div>

