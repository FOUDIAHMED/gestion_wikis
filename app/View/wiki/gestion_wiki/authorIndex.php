

<?php
$title = "Wiki page";
ob_start();
?>

    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

        <?php echo $title;?>
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                    <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.php?action=author"
                                aria-expanded="false">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                <span class="hide-menu">author</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.php?action=author_wiki_table"
                                aria-expanded="false">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                <span class="hide-menu">wikis</span>
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>
        </aside>
        <div class="page-wrapper">
        <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title"><a href="index.php?action=home">HOME</a></h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <!-- <li><a href="#" class="fw-normal">Dashboard</a></li> -->
                            </ol>
                            <a href="index.php?action=logout" target="_blank"
                                class="btn btn-danger  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        <div id="content">
            <!-- Topbar -->
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Tables</h1>
                </p>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="col-md-12 text-right mb-3">
                            <a href="index.php?action=wiki_create" class="btn btn-success">Create Wiki</a>
                        </div>
                        <div class="table-responsive">

                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Content</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Tags</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Is Archived</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($wikis as $wiki): ?>
                                    <tr>

                                        <td>
                                            <?= $wiki->getTitle(); ?>
                                        </td>
                                        <td>
                                            <?php
                                                $content = $wiki->getContent();
                                                echo substr($content, 0, 50);
                                                if (strlen($content) > 100) {
                                                    echo '...';
                                                }
                                                ?>
                                        </td>
                                        <td>
                                            <?= $wiki->getCategoryName(); ?>
                                        </td>
                                        <td>
                                            <?php
                                                $tags = $wiki->getTags();
                                                foreach ($tags as $tag) {
                                                    echo $tag->getName() . ', ';
                                                }
                                                ?>
                                        </td>
                                        <td>
                                            <?= $wiki->getCreatedAt(); ?>
                                        </td>
                                        <td>
                                            <?= $wiki->isArchived(); ?>
                                        </td>
                                        <td>

                                            <a href="index.php?action=wiki_edit&id=<?= $wiki->getId(); ?>"
                                                class=" btn btn-primary btn-sm">Edit</a>

                                            <a href="index.php?action=wiki_delete&id=<?= $wiki->getId(); ?>"
                                                class=" btn btn-danger btn-sm">Delete</a>

                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
           

                
                    
            <footer class="footer text-center"> 2021 © Ample Admin brought to you by <a
                    href="https://www.wrappixel.com/">wrappixel.com</a>
            </footer>
        </div>
    <?php
$content = ob_get_clean();
include_once 'app/views/include/layout_sub.php';
?>