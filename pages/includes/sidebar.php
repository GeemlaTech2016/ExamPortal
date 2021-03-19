                <?php
                    $filename = basename($_SERVER['PHP_SELF']);
                ?>
                <div class="page-sidebar-wrapper">
                    <!-- BEGIN SIDEBAR -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <div class="page-sidebar navbar-collapse collapse">
                        <!-- BEGIN SIDEBAR MENU -->
                        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <li class="sidebar-toggler-wrapper hide">
                                <div class="sidebar-toggler">
                                    <span></span>
                                </div>
                            </li>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                            <li class="sidebar-search-wrapper">
                                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                                <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                                <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                                <form class="sidebar-search  " action="page_general_search_3.html" method="POST">
                                    <a href="javascript:;" class="remove">
                                        <i class="icon-close"></i>
                                    </a>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search...">
                                        <span class="input-group-btn">
                                            <a href="javascript:;" class="btn submit">
                                                <i class="icon-magnifier"></i>
                                            </a>
                                        </span>
                                    </div>
                                </form>
                                <!-- END RESPONSIVE QUICK SEARCH FORM -->
                            </li>
                            <li class="nav-item start active open">
                                <a href="home.php" class="nav-link ">
                                    <i class="icon-home"></i>
                                    <span class="title">Dashboard</span>
                                    <span class="selected"></span>
                                    <span class="arrow open"></span>
                                </a>
                            </li>
                            <li class="heading">
                                <h3 class="uppercase">Features</h3>
                            </li>
                            <?php
                                if($user_role=="admin"){
                            ?>
                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-bulb"></i>
                                    <span class="title">EXAM SETUP</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="newexam.php" class="nav-link ">
                                        <i class="icon-users"></i>
                                            <span class="title">New Exam</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="testexams.php" class="nav-link ">
                                        <i class="icon-magnifier"></i>
                                            <span class="title">Test Exams</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="liveexams.php" class="nav-link ">
                                        <i class="icon-printer"></i>
                                            <span class="title">Live Exams</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="#" class="nav-link ">
                                        <i class="icon-doc"></i>
                                            <span class="title">Export to Excel</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-user"></i>
                                    <span class="title">USERS</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="newuser.php" class="nav-link ">
                                            <i class="icon-user-follow"></i>
                                            <span class="title">New User</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="allcandidates.php" class="nav-link ">
                                            <i class="icon-users"></i>
                                            <span class="title">Test Takers</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="#" class="nav-link ">
                                            <i class="icon-doc"></i>
                                            <span class="title">Export to Excel</span>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </li>

                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-user"></i>
                                    <span class="title">REPORTS</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="todaysexam.php" class="nav-link ">
                                            <i class="icon-user"></i>
                                            <span class="title">Today's Exams</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="completedexams.php" class="nav-link ">
                                            <i class="icon-user"></i>
                                            <span class="title">Completed Exams</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="allfeedbacks.php" class="nav-link ">
                                            <i class="icon-list"></i>
                                            <span class="title">Feedbacks</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="#" class="nav-link ">
                                            <i class="icon-printer"></i>
                                            <span class="title">Print List</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="#" class="nav-link ">
                                            <i class="icon-doc"></i>
                                            <span class="title">Export to Excel</span>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </li>
                            
                            <?php
                                }elseif($user_role=="testtaker"){
                            ?>
                            <?php
                                if($filename!='examproper.php'){
                            ?>
                            <li class="nav-item ">
                                <a href="takeexam.php" class="nav-link nav-toggle">
                                    <i class="icon-pencil"></i>
                                    <span class="title">Take Exam</span>
                                </a>
                            </li>
                            <?php
                                }
                            ?>
                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-bulb"></i>
                                    <span class="title">Exams Taken</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <?php
                                    $getex = mysqli_query($conn, "select * from scores where candidateid='".$user."'");
                                    while($rex = mysqli_fetch_array($getex)){
                                        if($rex['testseries']!=''){
                                            $getexm = mysqli_fetch_array(mysqli_query($conn,"select * from testseries where id='".$rex['testseries']."'"));
                                    ?>
                                    <li class="nav-item  ">
                                        <a href="result.php?testseries=<?php echo $rex['testseries']?>&qsession=<?php echo $rex['qsession']?>" class="nav-link ">
                                        <i class="icon-magnifier"></i>
                                            <span class="title"><?php echo $getexm['testseries']?></span>
                                        </a>
                                    </li>
                                    <?php
                                        }else{
                                            ?>
                                            <li class="nav-item  ">
                                                <a href="" class="nav-link ">
                                                <i class="icon-magnifier"></i>
                                                    <span class="title">No Exams Yet</span>
                                                </a>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                    
                                </ul>
                            </li>
                            <?php
                                if($filename=='takeexam.php'){
                            ?>
                            <li class="nav-item ">
                                <a onclick="openFeedback();" class="nav-link nav-toggle">
                                    <i class="icon-pencil"></i>
                                    <span class="title">Give Feedback</span>
                                </a>
                            </li>
                            <?php
                                }
                            ?>
                            <?php
                                }elseif($user_role=="supervisor"){
                                    ?>
                                    <li class="nav-item  ">
                                        <a href="javascript:;" class="nav-link nav-toggle">
                                            <i class="icon-bulb"></i>
                                            <span class="title">PVS</span>
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="sub-menu">
                                            
                                            <li class="nav-item  ">
                                                <a href="findpv.php" class="nav-link ">
                                                <i class="icon-magnifier"></i>
                                                    <span class="title">Find PV</span>
                                                </a>
                                            </li>
                                            <li class="nav-item  ">
                                                <a href="myapprovedpvs.php" class="nav-link ">
                                                <i class="icon-magnifier"></i>
                                                    <span class="title">My Approved PVs</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <?php
                                }
                                ?>
                            <li class="nav-item ">
                                <a href="out.php" class="nav-link nav-toggle">
                                    <i class="icon-logout"></i>
                                    <span class="title">Logout</span>
                                </a>
                            </li>
                            
                        </ul>
                        <!-- END SIDEBAR MENU -->
                    </div>