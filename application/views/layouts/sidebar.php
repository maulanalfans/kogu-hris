 <!-- sidebar -->
 <div class="sidebar px-4 py-2 py-md-4 me-0">
     <div class="d-flex flex-column h-100">
         <a href="<?= base_url() ?>" class="mb-0 brand-icon">
             <span class="logo-icon">
                 <img src="<?= base_url('assets/images/logo.png') ?>" alt="login-img" style="max-width: 50%;">
             </span>
             <span class="logo-text"><?= SITE_NAME ?></span>
         </a>

         <!-- Menu: main ul -->
         <ul class="menu-list flex-grow-1 mt-3">
             <?php
                foreach (menuAttributes() as $menus => $menu) {
                    if (isset($menu['has_child']) && $menu['has_child'] == TRUE) {
                ?>
                     <li class="collapsed">
                         <a class="m-link" data-bs-toggle="collapse" data-bs-target="#<?= $menu['menu'] ?>-Components" href="<?= base_url($menu['url']) ?>">
                             <i class="<?= $menu['icon'] ?>"></i> <span><?= $menu['menu'] ?></span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                         <!-- Menu: Sub menu ul -->
                         <ul class="sub-menu collapse show" id="<?= $menu['menu'] ?>-Components">
                             <?php
                                foreach ($menu['childMenu'] as $child) {
                                ?>
                                 <li><a class="ms-link <?= menuActive($child['url'], $this->uri->segment(1)) ?>" href="<?= base_url($child['url']) ?>"> <span><?= $child['childMenu'] ?></span></a></li>
                             <?php
                                }
                                ?>
                         </ul>
                     </li>
                 <?php
                    } else {
                    ?>
                     <li><a class="m-link" href="<?= base_url($menu['url']) ?>"><i class="<?= $menu['icon'] ?>"></i> <span><?= $menu['menu'] ?></span></a></li>
             <?php
                    }
                }
                ?>
         </ul>
     </div>
 </div>