<!doctype html>
<html lang="en">
    <head>
        <?php $this->load->view("template/_partials/head"); ?>
    </head>
    <body>
        <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Data Mahasiswa</a>
            <!-- <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
                <a class="nav-link" href="#">Sign out</a>
                </li> -->
            <!-- </ul> -->
        </nav>
        <div class="container-fluid">
            <div class="row">
                <?php $this->load->view("template/_partials/sidebar"); ?>
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                    <?php $this->load->view("template/_partials/navigation"); ?>
                    <?php $this->load->view($page_url); ?>
                    <?php $this->load->view("template/_partials/footer"); ?>
                </main>
            </div>
        </div>
        <?php $this->load->view("template/_partials/js"); ?>
    </body>
</html>
