<header class="bg-white p-3 mb-3 border-bottom ">
    
      <div class="d-flex flex-wrap align-items-center justify-content-between">
       
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><img src="image/logo.png" width="50" height="50"></svg>
        </a>

        <ul class="nav col-10 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="index.php" class="nav-link px-2 link-secondary">HOME</a></li>
          <li><a href="#" class="nav-link px-2 link-body-emphasis">Hakkında</a></li>
          <li><a href="#" class="nav-link px-2 link-body-emphasis">iletişim</a></li>
        </ul>

        
        
 
       
          <?php 
          if(isset($_SESSION['username'])){
          
          echo '
                 <div class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 ">
        <a href="sepet.php" class="nav-link text-white">
                <img src="image/basket-outline.svg" width="30" height="30">
              </a>
</div>
           <div class="dropdown text-end">
          <a href="" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small" style="">
            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
            <li><a class="dropdown-item" href="siparislerim.php">Siparişlerim</a></li>
            ';
            if($_SESSION['role']=="firma"){
              echo' <li><a class="dropdown-item" href="company_panel.php">Firma Profili</a></li>
              <li> <a class="dropdown-item" href="siparis_yönetim.php">sipariş yönetimi</a></li>';
              
            }
            if($_SESSION['username']=="admin"){
              echo ' <li><a class="dropdown-item" href="Admin_panel.php">Admin Panel</a></li>';
            }
           echo'
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="logout.php">Çıkış Yap</a></li>
            
          </ul>';
          }
          else{
            echo'
            <button type="button" onclick="window.location.href=\'login.php\'" class="btn btn-outline-success btn-danger text-white">Giriş Yap</button>
<button type="button" onclick="window.location.href=\'sing-in.php\'" class=" mx-2 btn btn-outline-danger btn-success text-white">Kayıt Ol</button>
';} ?>

          </ul>
        </div>
      </div>
    
  </header>
