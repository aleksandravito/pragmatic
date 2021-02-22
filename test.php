<!DOCTYPE html>
<html>
<head>
    <title>Pragmatic</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
<?php
require_once "connection.php";

$limit = 5;
if (isset($_GET["page"])) {
    $pn = $_GET["page"];
}
else {
    $pn=1;
};

if (isset($_GET["limiti"])) {
    $limit = $_GET["limiti"];
}
else {
    $limit=5;
};

$start_from = ($pn-1) * $limit;

?>
<div class="wrapper">
    <div class="menu">
        <div class="navigation-menu">
            <div class="nav-row">
                <div class="row">
                    <div class="col-2">
                        <a href="/">
                            <img src="images/5e874407889277e434e86fb8_logo.png" width="100" alt="logo-website">
                        </a>
                    </div>
                    <div class="col-8">
                        <nav role="navigation" class="nav-elements">
                            <div class="elements">
                                <div class="navigation-link col-2" role="button" tabindex="0">
                                    <div onclick="menuDropdown()" class="dropbtn">THE&nbsp;PLATFORM <i class="arrow down"></i></div>
                                    <div id="menuDropdown" class="dropdown-content">
                                        <a href="#">For Trade Workers</a>
                                        <a href="#">For Employers</a>
                                        <a href="#">For Students</a>
                                        <a href="#">For Schools</a>
                                        <div class="navigation-dropdown-footer">
                                            <img src="images/5e874407889277e434e86fb8_logo.png" width="100" alt="">
                                        </div>
                                    </div>
                                </div>
                                <a class="col-2 navigation-link">Find Jobs</a>
                                <a class="col-2 navigation-link">Find Tools</a>
                                <div class="navigation-link col-2" role="button" tabindex="0">
                                    <div onclick="ShowElements()" class="dropbtn">Resources <i class="arrow down"></i></div>
                                    <div id="ShowElements" class="dropdown-content">
                                        <a href="#">Who we are</a>
                                        <a href="#">Investors</a>
                                        <a href="#">FAQ</a>
                                        <a href="#">Support</a>
                                        <a href="#">Blog</a>
                                        <a href="#">Policy</a>
                                        <a href="#">Contact Us</a>
                                        <div class="navigation-dropdown-footer">
                                            <img src="images/5e874407889277e434e86fb8_logo.png" width="100" alt="">
                                        </div>
                                    </div>
                                </div>
                                <a class="col-2 navigation-link">Post Jobs</a>
                            </div>
                        </nav>
                    </div>
                    <div class="col-2">
                        <div class="navigation-actions">
                            <div class="navigation-action">
                                <a href="/signup-new-user" class="button button-small">Sign Up</a>
                            </div>
                            <div class="navigation-action">
                                <a href="https://app.tradesfactor.com/Home/DefaultDashboard" class="button button-small">Sign In</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <h1>Find your job in the trades</h1>
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <div id="pragmatic-search">
                    <div class="form">
                        <form id="search" action="https://app.tradesfactor.com/api/jobs/list" method="get">
                            <label class="form-label" for="Trades">
                                Trades
                                <span class="field-validation-valid"></span>
                            </label>
                            <input class="input w-input" placeholder="Boilermaker, Carpentar, Pipefitter" type="text" id="Trades" name="Trades" value="">

                            <label class="form-label" for="Location">
                                Location
                                <span class="field-validation-valid"></span>
                            </label>

                            <input class="input w-input pac-target-input" placeholder="Enter your location" type="text" id="Location" name="Location" value="" autocomplete="off">

                            <input type="submit" value="Search" data-wait="Please wait..." class="button button-small">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
    <div class="section section-video section-light">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
            <h2 class="center">Open Positions</h2>
            <div class="inline">
                <span class="w-inline-block text-small">Showing </span>
                <span class="w-inline-block text-small">
                    <select name="limiti" id="limiti" onchange="go2Page();">
                        <?php
                        $no_rows = [5,10,20];
                        foreach ($no_rows as $row) {
                            if ( $limit == $row ) {
                                echo "<option id='" . $row . "' value='" . $row . "' selected=\"selected\">" . $row . "</option>";
                            }
                            else {
                                echo "<option id='" . $row . "' value='" . $row . "'>" . $row . "</option>";
                            }
                        }

                        ?>
                    </select>
                </span>
                <?php
                $sql = "SELECT COUNT(*) FROM job_openings";
                $rs_result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_row($rs_result);
                ?>
                <span class="w-inline-block text-small">results out of <?php echo $row[0]; ?>.  </span>
            </div>
            <div class="pagination">
                <?php
                $sql = "SELECT COUNT(*) FROM job_openings";
                $rs_result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_row($rs_result);
                $total_records = $row[0];
                $total_pages = ceil($total_records / $limit);
                $k = (($pn+4>$total_pages)?$total_pages-4:(($pn-4<1)?5:$pn));
                $pagLink = "";

                if($pn>=2){
                    echo "<span><a href='test.php?page=".($pn-1)."&limiti=". $limit ."#fokusi'> Previous </a> |  </span>";
                }
                else {
                    echo "<span class='inactive'><a href='#'> Previous </a> |  </span>";
                }
                for ($i=-4; $i<=4; $i++) {
                    if($k+$i==$pn)
                        $pagLink .= "<span class='active'>".$pn."</span>";
                };
                echo $pagLink;
                if($pn<$total_pages){
                    echo "<span>  | <a href='test.php?page=".($pn+1)."&limiti=". $limit ."#fokusi'> Next </a></span>";
                }
                else {
                    echo "<span class='inactive'>  | <a href='#'> Next </a></span>";
                }

                ?>
            </div>
            </div>
            <div class="col-3"></div>
        </div>
        <?php
        $sql = "SELECT * FROM job_openings LIMIT $start_from, $limit";
        $rs_result = mysqli_query ($conn, $sql);
        ?>
        <div class="table table-striped table-condensed table-bordered" id="fokusi">
            <?php
            while ($row = mysqli_fetch_array($rs_result, MYSQLI_ASSOC)) { ?>
                <div class="row">
                <div class="col-2"></div>
                <div class="jobs-item col-8">
                    <div class="position">
                        <div class="flex-columns jobs">
                            <div class="column w-clearfix row">
                                <div class="col-2">
                                    <img src="<?php echo $row["img"]; ?>" width="60" alt="" class="jobs-icon">
                                </div>
                                <div class="col-7">
                                    <div style="padding-left: 30px;">
                                        <strong><?php echo $row["title"]; ?></strong>
                                        <span><?php echo $row["year"]; ?></span>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="positions-apply"><button onclick="appearDetails('<?php echo $row["id"]; ?>')" class="button-apply">Details</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="display: none;" id="<?php echo $row["id"]; ?>">
                        <?php echo $row["description"]; ?>
                    </div>
                </div>
                <div class="col-2"></div>
                </div>
                <?php
            };
            ?>
        </div>
    </div>
    <div class="section-subscribe">
        <div class="row">
        <div class="col-4"></div>
        <div class="footer-subscribe col-4">
            <img src="images/5e872c3724884d065444cf0d_icons8-like-message-100.png" width="50" alt="" class="subscribe-icon center">
            <p class="text-light-grey text-small">Sign up to recieve a monthly email on the latest news!</p>
            <div class="w-form">
                <form id="wf-form-emailNewsFrom" name="wf-form-emailNewsFrom" data-name="emailNewsFrom">
                    <div class="input-group-inline">
                        <input type="email" class="input-inline w-input" maxlength="256" name="emailNews" data-name="Email News" placeholder="Email address" id="emailNews" required="">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-4"></div>
        </div>
        <div class="devider"></div>
    </div>
    <div class="footer">
        <div class="footer-column">
            <div class="row">
                <div class="col-3">
                    <div>
                        <a href="/webtemplatepages/old-home" class="brand-logo footer-logo w-nav-brand">
                            <img src="images/5e874407889277e434e86fb8_logo.png" width="100" alt=""></a>
                    </div>
                    <div class="footer-social-icons">
                        <a href="https://www.facebook.com/tradesfactor/" class="footer-social facebook w-inline-block"></a>
                        <a href="https://twitter.com/tradesfactor" class="footer-social twitter w-inline-block"></a>
                        <a href="https://www.instagram.com/tradesfactor/" class="footer-social instagram w-inline-block"></a>
                    </div>
                </div>
                <div class="col-9">
                    <div class="row" style="margin-bottom: 60px;">
                        <div class="col-4">
                            <h6 class="footer-nav-title">The Platform</h6>
                            <ul class="footer-links">
                                <li><a href="/" class="footer-link text-small">For Trade Workers</a></li>
                                <li><a href="/tradesfactor-schools" class="footer-link text-small">For Students</a></li>
                                <li><a href="/employers-post-a-job" class="footer-link text-small">For Employers</a></li>
                                <li><a href="/tradesfactor-for-schools" class="footer-link text-small">For Schools</a></li>
                            </ul>
                        </div>
                        <div class="col-4">
                            <h6 class="footer-nav-title">Resources</h6>
                            <ul class="footer-links">
                                <li><a href="/blog-tradesfactor" class="footer-link text-small">Blog</a></li>
                            </ul>
                        </div>
                        <div class="col-4">
                            <h6 class="footer-nav-title">Company</h6>
                            <ul class="footer-links">
                                <li><a href="/about" class="footer-link text-small">About</a></li>
                                <li><a href="/find-a-job" aria-current="page" class="footer-link text-small w--current">Jobs</a></li>
                                <li><a href="/tradesfactor-faq" class="footer-link text-small">FAQ</a></li>
                                <li><a href="#" target="_blank" class="footer-link text-small">Support</a></li>
                                <li><a href="/policy" class="footer-link text-small">Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copy">
            <div class="row">
                <div class="col-5">
                    <div class="footer-copy-text hint">© Copyright TradesFactor 2020. All rights reserved</div>
                </div>
                <div class="footer-copy-link-column col-6">
                    <a href="/policy" class="footer-copy-link hint">Privacy policy</a>
                    <a href="/policy" class="footer-copy-link hint">Terms and services</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
