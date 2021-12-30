<?php $ip = $_SERVER['HTTP_CLIENT_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['HTTP_X_REAL_IP'] ?? $_SERVER['REMOTE_ADDR'] ?>

<header class="container-fluid black-bg">
  <?php include 'menu.php'?>

  <div id="" class="row ">
    <!--<div class="col-6 col-sm-6 col-md-4 col-lg-4">-->
    <div class="col-sm-6 col-md-4 col-lg-4">
      <div class="header-quote">
        <div id="FormContainer" class="FormContainer">
          <h3>Request A Case Evaluation</h3>
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

          <div style="text-align:right; font-size:x-small;"></div>
        </div>
      </div>
    </div>
    <!--<div class="col-6 col-sm-6 col-md-8 col-lg-8">-->
    <div class="col-sm-6 col-md-8 col-lg-8">
      <div class="header-image-container">
        <img 

        src="<?php echo DIR_HTTPS_CATALOG.DIR_IMAGES?>bailyn-law-firm-2020.jpg"

        alt="Bradley R. Bailyn, Esq., Founder"

        title="Bradley R. Bailyn, Esq., Founder"

        class=""

        />
      </div>
    </div>
  </div> 
</header>
