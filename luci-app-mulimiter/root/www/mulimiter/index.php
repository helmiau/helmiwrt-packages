<?php
ini_set('display_errors', 1);
error_reporting(0);

session_start();

$dir = '/root/.mulimiter';
$app_name = 'mulimiter';

if ($_SESSION[$app_name]['logedin'] == true) {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($_GET['act'] == 'add') {
            if ($_POST['iprange0'] && $_POST['dspeed'] && $_POST['uspeed']) {
                $iprange = $_POST['iprange0'] . '-' . ($_POST['iprange1'] ? $_POST['iprange1'] : $_POST['iprange0']);
                $uspeed   = $_POST['uspeed'] . 'kb/s';
                $dspeed   = $_POST['dspeed'] . 'kb/s';

                $timestart = $_POST['timestart'];
                $timestop = $_POST['timestop'];

                $mod_time = '';
                if ($timestart && $timestop) {
                    $mod_time = "-m time --timestart $timestart --timestop $timestop";
                }

                $arr_weekdays = $_POST['weekdays'];
                if ($arr_weekdays) {
                    $weekdays = implode(',', $arr_weekdays);
                    if ($mod_time) {
                        $mod_time .= " --weekdays $weekdays";
                    } else {
                        $mod_time .= "-m time --weekdays $weekdays";
                    }
                }

                $mulid = dechex(time());
                $uname = 'mulimiter_u' . $mulid;
                $dname = 'mulimiter_d' . $mulid;

                //APPLY
                //download
                shell_exec("iptables -I FORWARD -m iprange --dst-range $iprange -m hashlimit --hashlimit-above $dspeed --hashlimit-mode dstip --hashlimit-name $dname $mod_time -j DROP");
                //upload
                shell_exec("iptables -I FORWARD -m iprange --src-range $iprange -m hashlimit --hashlimit-above $uspeed --hashlimit-mode srcip --hashlimit-name $uname $mod_time -j DROP");
                //END APPLY

                $list = shell_exec('iptables -S');
                $list = str_replace("\r\n", "\n", $list);
                $list = explode("\n", $list);
                $limiters = [];
                $dcurrent = '';
                $ucurrent = '';
                foreach ($list as $ls) {
                    if (strpos($ls, 'mulimiter') !== FALSE) {
                        $limiters[] = $ls;
                    }
                    if (strpos($ls, $dname) !== FALSE) {
                        $dcurrent = $ls;
                    }
                    if (strpos($ls, $uname) !== FALSE) {
                        $ucurrent = $ls;
                    }
                }
                if ($dcurrent && $ucurrent) {
                    $old    = shell_exec("cat $dir/save");
                    $new    = trim($dcurrent . "\n" . $old, "\n");
                    $new    = trim($ucurrent . "\n" . $new, "\n");

                    shell_exec("echo \"$new\" > $dir/save");
                    echo json_encode([
                        'success' => true
                    ]);
                }
            }
        } elseif ($_GET['act'] == 'delete') {
            if ($_POST['drule'] && $_POST['urule']) {
                $drule           = base64_decode($_POST['drule']);
                $urule           = base64_decode($_POST['urule']);

                $delete_drule    = str_replace('-A ', '-D ', $drule);
                $delete_urule    = str_replace('-A ', '-D ', $urule);

                $saved_rules    = str_replace("\r\n", "\n", shell_exec("cat $dir/save"));
                $saved_rules    = explode("\n", $saved_rules);
                $untouched      = '';
                foreach ($saved_rules as $sv) {
                    if ($sv != $urule && $sv != $drule) {
                        $untouched .= $sv . "\n";
                    }
                }

                $untouched = trim($untouched, "\n");

                shell_exec("iptables $delete_drule");
                shell_exec("iptables $delete_urule");

                shell_exec("echo \"$untouched\" > $dir/save");

                echo json_encode([
                    'success' => true
                ]);
            }
        } elseif ($_GET['act'] == 'edit') {

            if ($_POST['drule'] && $_POST['urule'] && $_POST['iprange0'] && $_POST['dspeed'] && $_POST['uspeed']) {

                //add first
                $iprange = $_POST['iprange0'] . '-' . ($_POST['iprange1'] ? $_POST['iprange1'] : $_POST['iprange0']);
                $uspeed   = $_POST['uspeed'] . 'kb/s';
                $dspeed   = $_POST['dspeed'] . 'kb/s';

                $timestart = $_POST['timestart'];
                $timestop = $_POST['timestop'];

                $mod_time = '';
                if ($timestart && $timestop) {
                    $mod_time = "-m time --timestart $timestart --timestop $timestop";
                }

                $arr_weekdays = $_POST['weekdays'];
                if ($arr_weekdays) {
                    $weekdays = implode(',', $arr_weekdays);
                    if ($mod_time) {
                        $mod_time .= " --weekdays $weekdays";
                    } else {
                        $mod_time .= "-m time --weekdays $weekdays";
                    }
                }

                $mulid = dechex(time());
                $uname = 'mulimiter_u' . $mulid;
                $dname = 'mulimiter_d' . $mulid;

                //APPLY
                //download
                shell_exec("iptables -I FORWARD -m iprange --dst-range $iprange -m hashlimit --hashlimit-above $dspeed --hashlimit-mode dstip --hashlimit-name $dname $mod_time -j DROP");
                //upload
                shell_exec("iptables -I FORWARD -m iprange --src-range $iprange -m hashlimit --hashlimit-above $uspeed --hashlimit-mode srcip --hashlimit-name $uname $mod_time -j DROP");
                //END APPLY

                $list = shell_exec('iptables -S');
                $list = str_replace("\r\n", "\n", $list);
                $list = explode("\n", $list);
                $limiters = [];
                $dcurrent = '';
                $ucurrent = '';
                foreach ($list as $ls) {
                    if (strpos($ls, 'mulimiter') !== FALSE) {
                        $limiters[] = $ls;
                    }
                    if (strpos($ls, $dname) !== FALSE) {
                        $dcurrent = $ls;
                    }
                    if (strpos($ls, $uname) !== FALSE) {
                        $ucurrent = $ls;
                    }
                }
                if ($dcurrent && $ucurrent) {
                    $old    = shell_exec("cat $dir/save");
                    $new    = trim($dcurrent . "\n" . $old, "\n");
                    $new    = trim($ucurrent . "\n" . $new, "\n");

                    shell_exec("echo \"$new\" > $dir/save");
                    //end of add }

                    //then delete {
                    $drule           = base64_decode($_POST['drule']);
                    $urule           = base64_decode($_POST['urule']);

                    $delete_drule    = str_replace('-A ', '-D ', $drule);
                    $delete_urule    = str_replace('-A ', '-D ', $urule);

                    $saved_rules    = str_replace("\r\n", "\n", shell_exec("cat $dir/save"));
                    $saved_rules    = explode("\n", $saved_rules);
                    $untouched      = '';
                    foreach ($saved_rules as $sv) {
                        if ($sv != $urule && $sv != $drule) {
                            $untouched .= $sv . "\n";
                        }
                    }

                    $untouched = trim($untouched, "\n");

                    shell_exec("iptables $delete_drule");
                    shell_exec("iptables $delete_urule");

                    shell_exec("echo \"$untouched\" > $dir/save");
                    //end of delete

                    echo json_encode([
                        'success' => true
                    ]);
                }
            }
        } elseif ($_GET['act'] == 'password') {
            $password       = $_POST['password'];
            $new_password   = $_POST['new_password'];
            $new_password2  = $_POST['new_password2'];

            if ($new_password == $new_password2) {
                $hash = base64_decode(trim(shell_exec("cat $dir/.userpass"), "\n"));
                if (password_verify($password, $hash)) {
                    $_SESSION[$app_name]['logedin'] = true;
                    shell_exec("echo \"" . base64_encode(password_hash($new_password, PASSWORD_BCRYPT)) . "\" > $dir/.userpass");
                    echo json_encode([
                        'success' => true
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Invalid password.'
                    ]);
                }
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => "Password doesn't match."
                ]);
            }
        } elseif ($_GET['act'] == 'logout') {
            unset($_SESSION[$app_name]);
            echo json_encode([
                'success' => true
            ]);
        } elseif ($_GET['act'] == 'uninstalldanhancurkan') {
            unset($_SESSION[$app_name]);
            shell_exec("rm -rf $dir");
            $custom_firewall = shell_exec("cat /etc/firewall.user");
            if (strpos($custom_firewall, '/root/.mulimiter/run') !== FALSE) {
                shell_exec("echo \"" . trim(str_replace('/root/.mulimiter/run', '', $custom_firewall), "\n") . "\n" . "\" > /etc/firewall.user");
            }
            $list = shell_exec('iptables -S');
            $list = str_replace("\r\n", "\n", $list);
            $list = explode("\n", $list);
            foreach ($list as $ls) {
                if (strpos($ls, 'mulimiter') !== FALSE) {
                    $delete_rule    = str_replace('-A ', '-D ', $ls);
                    shell_exec("iptables $delete_rule");
                }
            }
            echo json_encode([
                'success' => true,
            ]);
            shell_exec("rm -rf /www/mulimiter");
        }
        exit;
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MulImiter</title>
        <link rel="stylesheet" href="asset/bootstrap.min.css">
        <style>
            .wraper {
                margin: auto;
                max-width: 100%;
            }
        </style>
        <script src="asset/jquery.min.js"></script>
    </head>

    <body style="background-color: #dedede;">
        <div class="wraper py-4 bg-white px-3">
            <h1 class="text-center">MulImiter</h1>
            <p class="text-center mb-4">The GUI bandwidth limiter for iptables-mod-hashlimit</p>
            <hr>
            <div class="mb-3 d-flex justify-content-center" style="gap: .5rem;">
                <button onclick="showHome()" class="btn btn-success">Home</button>
                <button onclick="showSetting()" class="btn btn-info">Setting</button>
                <button onclick="showAbout()" class="btn btn-warning">About</button>
                <button onclick="logout()" class="btn btn-danger">Logout</button>
            </div>
            <hr class="mb-4">
            <div id="home-page">
                <form method="post" id="mulimiterFormAdd">
                    <table class="table table-sm table-borderless">
                        <tbody>
                            <tr>
                                <td>IP/Range</td>
                                <td>:</td>
                                <td>
                                    <div class="d-flex" style="align-items: center; ">
                                        <input class="form-control form-control-sm" name="iprange0" placeholder="ex: 10.0.0.1" required>
                                        &nbsp;-&nbsp;
                                        <input name="iprange1" class="form-control form-control-sm" placeholder="ex: 10.0.0.100 (optional)">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>D Speed</td>
                                <td>:</td>
                                <td>
                                    <div class="d-flex" style="align-items: center; ">
                                        <input class="form-control form-control-sm w-25" type="number" name="dspeed" required> &nbsp;&nbsp;kB/s
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>U Speed</td>
                                <td>:</td>
                                <td>
                                    <div class="d-flex" style="align-items: center; ">
                                        <input class="form-control form-control-sm w-25" type="number" name="uspeed" required> &nbsp;&nbsp;kB/s
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Time</td>
                                <td>:</td>
                                <td>
                                    <div class="d-flex" style="align-items: center; ">
                                        <input class="form-control form-control-sm" style="width: 100%; max-width:140px" type="time" name="timestart">
                                        &nbsp;-&nbsp;
                                        <input class="form-control form-control-sm" style="width: 100%; max-width:140px" type="time" name="timestop">
                                        &nbsp;&nbsp;<span class="d-none d-lg-block"><i>If emptied, it will work all time.</i></span>
                                    </div>
                                    <span class="d-lg-none"><i>If emptied, it will work all time.</i></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Day</td>
                                <td>:</td>
                                <td>
                                    <i>For everyday, left them unchecked or check them all.</i><br>
                                    <input name="weekdays[]" type="checkbox" value="Mon"> Monday <br>
                                    <input name="weekdays[]" type="checkbox" value="Tue"> Tuesday <br>
                                    <input name="weekdays[]" type="checkbox" value="Wed"> Wednesday <br>
                                    <input name="weekdays[]" type="checkbox" value="Thu"> Thursday <br>
                                    <input name="weekdays[]" type="checkbox" value="Fri"> Friday <br>
                                    <input name="weekdays[]" type="checkbox" value="Sat"> Saturday <br>
                                    <input name="weekdays[]" type="checkbox" value="Sun"> Sunday <br>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><input type="submit" class="btn btn-success btn-sm" value="Add"></td>
                            </tr>
                        </tbody>
                    </table>

                </form>
                <hr>
                <table class="table table-sm table-bordered text-center">
                    <thead>
                        <th>IP/Range</th>
                        <th>D Speed</th>
                        <th>U Speed</th>
                        <th>Time</th>
                        <th>Days</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                        $list = shell_exec('iptables -S');
                        $list = str_replace("\r\n", "\n", $list);
                        $list = explode("\n", $list);
                        $limiters = [];
                        foreach ($list as $i => $ls) {
                            $mulid = '';
                            if (strpos($ls, 'mulimiter_d') !== FALSE) {
                                $rule       = explode(' ', $ls);

                                $iprange    = $rule[5];
                                $iprange    = explode('-', $iprange);
                                $iprange    = $iprange[0] . ($iprange[1] != $iprange[0] ? ' - ' . $iprange[1] : '');
                                $dspeed     = $rule[9];

                                $weekdays = "Everyday";
                                $time = "All time";
                                $time0 = '';
                                foreach ($rule as $i => $rl) {
                                    if ($rl == '--weekdays') {
                                        $weekdays = $rule[$i + 1];
                                        $days = explode(',', $weekdays);
                                        if (count($days) == 7)
                                            $weekdays = "Everyday";
                                    } elseif ($rl == "--timestart") {
                                        $time0 = date('H:i', strtotime($rule[$i + 1]));
                                    } elseif ($rl == "--timestop") {
                                        $time1 = date('H:i', strtotime($rule[$i + 1]));
                                    }

                                    //get mulid
                                    if ($rl == '--hashlimit-name') {
                                        $mulid = str_replace('mulimiter_d', 'mulimiter_u', $rule[$i + 1]);
                                    }
                                }

                                if ($time0) {
                                    $time = $time0 . ' - ' . $time1;
                                }

                                $filter_mulid   = preg_quote($mulid, '~');
                                $upload_rule    = preg_grep('~' . $filter_mulid . '~', $list);
                                foreach ($upload_rule as $upload_rule);
                                $urule          = $upload_rule;
                                $xurule         = explode(' ', $upload_rule);
                                $uspeed         = $xurule[9];
                        ?>
                                <tr>
                                    <td><span id="textIpRange_<?= $i ?>"><?= $iprange ?></span></td>
                                    <td><span id="textDSpeed_<?= $i ?>"><?= str_replace('kb', ' kB', $dspeed) ?></span></td>
                                    <td><span id="textUSpeed_<?= $i ?>"><?= str_replace('kb', ' kB', $uspeed) ?></span></td>
                                    <td><span id="textTime_<?= $i ?>"><?= $time ?></span></td>
                                    <td><span id="textWeekdays_<?= $i ?>"><?= $weekdays ?></span></td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm" data-drule="<?= base64_encode($ls) ?>" data-urule="<?= base64_encode($urule) ?>" onclick="editRule(this)">Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm" data-drule="<?= base64_encode($ls) ?>" data-urule="<?= base64_encode($urule) ?>" onclick="deleteRule(this)">Delete</button>
                                    </td>
                                </tr>
                        <?php }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="text-center d-none" id="about-page">
                <h2>About</h2>
                <p>MulImiter, The GUI bandwidth limiter for iptables-mod-hashlimit.</p>
                <p>Required iptables-mod-iprange, iptables-mod-hashlimit.</p>
                <p>Source Code: https://github.com/tegohsx/mulimiter/</p>
                <p class="mt-4">
                    <button class="btn btn-danger" onclick="uninstallMe(this)">Uninstall MulImiter</button>
                </p>
            </div>
            <div class="text-center d-none" id="setting-page">
                <h2>Setting</h2>
                <p>Change your password.</p>
                <hr>
                <form id="mulimiterFormPassword">
                    <div class="mb-5">
                        <label class="mb-2">Current Password:</label>
                        <input type="password" name="password" class="form-control mb-3" style="max-width: 400px; margin:auto">
                        <label class="mb-2">New Password:</label>
                        <input type="password" name="new_password" class="form-control mb-3" style="max-width: 400px; margin:auto">
                        <label class="mb-2">Confirm:</label>
                        <input type="password" name="new_password2" class="form-control mb-3" style="max-width: 400px; margin:auto">
                        <input type="submit" class="btn btn-success" value="Change">
                    </div>
                </form>
            </div>
            <hr>
            <p class="text-center">Author: &nbsp;&nbsp;<a href="https://github.com/tegohsx/" target="_blank">Tegohsx</a></p>
        </div>
        <script>
            let state = {}
            state.formEditType = 'add'

            if (!inIframe()) {
                $('.wraper').css({
                    maxWidth: '720px'
                })
            }

            function inIframe() {
                try {
                    return window.self !== window.top;
                } catch (e) {
                    return true;
                }
            }

            $("#mulimiterFormAdd").on('submit', function(e) {
                e.preventDefault();
                if (state.formEditType == 'add') {
                    $(this).find('[type=submit]').val('Adding...').prop('disabled', true)
                    $.ajax({
                        type: 'post',
                        url: '<?= $_SERVER['PHP_SELF'] ?>?act=add',
                        dataType: 'json',
                        cache: false,
                        data: $(this).serialize(),
                        success: r => {
                            if (r.success) {
                                location.reload()
                            } else {
                                alert(r.message)
                            }
                        }
                    })
                } else if (state.formEditType == 'edit') {
                    $(this).find('[type=submit]').val('Saving...').prop('disabled', true)
                    let fdata = new FormData(this)
                    fdata.append('drule', state.drule)
                    fdata.append('urule', state.urule)
                    $.ajax({
                        type: 'post',
                        url: '<?= $_SERVER['PHP_SELF'] ?>?act=edit',
                        dataType: 'json',
                        cache: false,
                        data: fdata,
                        contentType: false,
                        processData: false,
                        success: r => {
                            if (r.success) {
                                location.reload()
                            } else {
                                alert(r.message)
                            }
                        }
                    })
                }
            })

            $("#mulimiterFormAdd").on('click', '#btnCancelEdit', function() {
                state.formEditType = 'add'
                $('#mulimiterFormAdd').find('[type=submit]').val('Add')
                $("#mulimiterFormAdd")[0].reset()
                $(this).remove()
            })

            $("#mulimiterFormPassword").on('submit', function(e) {
                e.preventDefault();
                $(this).find('[type=submit]').val('Changing...').prop('disabled', true)
                $.ajax({
                    type: 'post',
                    url: '<?= $_SERVER['PHP_SELF'] ?>?act=password',
                    dataType: 'json',
                    cache: false,
                    data: $(this).serialize(),
                    success: r => {
                        if (r.success) {
                            alert("Success.")
                            $("#mulimiterFormPassword")[0].reset()
                        } else {
                            alert(r.message)
                            $(this).find('[type=submit]').val('Change').prop('disabled', false)
                        }
                    }
                })
            })

            function editRule(el) {
                state.formEditType = 'edit'
                state.drule = $(el).attr('data-drule')
                state.urule = $(el).attr('data-urule')
                let iprange = $(el).closest('tr').find('[id^=textIpRange_]').text().split(' - ')
                let iprange0 = iprange[0],
                    iprange1 = iprange[1] || '',
                    dspeed = parseInt($(el).closest('tr').find('[id^=textDSpeed_]').text()),
                    uspeed = parseInt($(el).closest('tr').find('[id^=textUSpeed_]').text()),
                    time_ = $(el).closest('tr').find('[id^=textTime_]').text().split(' - '),
                    timestart = time_[0] == 'All time' ? '' : (time_[0] || ''),
                    timestop = time_[1] || '',
                    weekdays = $(el).closest('tr').find('[id^=textWeekdays_]').text().split(',')

                $('#mulimiterFormAdd').find('[name=iprange0]').val(iprange0).focus()
                $('#mulimiterFormAdd').find('[name=iprange1]').val(iprange1)
                $('#mulimiterFormAdd').find('[name=dspeed]').val(dspeed)
                $('#mulimiterFormAdd').find('[name=uspeed]').val(uspeed)
                $('#mulimiterFormAdd').find('[name=timestart]').val(timestart)
                $('#mulimiterFormAdd').find('[name=timestop]').val(timestop)

                $('#mulimiterFormAdd').find('[name^=weekdays]').prop('checked', false)
                weekdays.forEach(v => {
                    $('#mulimiterFormAdd').find('[name^=weekdays][value=' + v + ']').prop('checked', true)
                })

                if (!$('#mulimiterFormAdd').find('#btnCancelEdit').length) {
                    $('#mulimiterFormAdd').find('[type=submit]').val('Save').after(`<input id="btnCancelEdit" type="reset" class="btn btn-danger btn-sm ms-1" value="Cancel">`)
                }

            }

            function deleteRule(el) {
                if (confirm('Delete this rule?')) {
                    let drule = $(el).attr('data-drule')
                    let urule = $(el).attr('data-urule')
                    $.ajax({
                        url: '<?= $_SERVER['PHP_SELF'] ?>?act=delete',
                        type: 'post',
                        dataType: 'json',
                        cache: false,
                        data: {
                            urule,
                            drule
                        },
                        success: r => {
                            if (r.success) {
                                location.reload()
                            }
                        }
                    })
                }
            }

            function uninstallMe(el) {
                if (confirm("Do you want to uninstall MulImiter?")) {
                    if (confirm("Yakin, nih, nggak nyesel?")) {
                        $.ajax({
                            type: 'post',
                            url: '<?= $_SERVER['PHP_SELF'] ?>?act=uninstalldanhancurkan',
                            data: "uninstall=true",
                            dataType: 'json',
                            success: r => {
                                if (r.success) {
                                    alert("Success.\n")
                                    location.reload()
                                }
                            }
                        })
                    }
                }
            }

            function logout() {
                $.ajax({
                    url: '<?= $_SERVER['PHP_SELF'] ?>?act=logout',
                    type: 'post',
                    dataType: 'json',
                    cache: false,
                    data: 'logout=true',
                    success: r => {
                        if (r.success) {
                            location.reload()
                        }
                    }
                })
            }

            function showHome() {
                if ($('#home-page').attr('class').includes('d-none')) {
                    $('#about-page').addClass('d-none');
                    $('#setting-page').addClass('d-none');
                    $('#home-page').removeClass('d-none');
                }
            }


            function showAbout() {
                if ($('#about-page').attr('class').includes('d-none')) {
                    $('#home-page').addClass('d-none');
                    $('#setting-page').addClass('d-none');
                    $('#about-page').removeClass('d-none');
                }
            }

            function showSetting() {
                if ($('#setting-page').attr('class').includes('d-none')) {
                    $('#home-page').addClass('d-none');
                    $('#about-page').addClass('d-none');
                    $('#setting-page').removeClass('d-none');
                }
            }
        </script>
    </body>

    </html>

<?php } else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $password = $_POST['password'];
        $hash = base64_decode(trim(shell_exec("cat $dir/.userpass"), "\n"));
        if (password_verify($password, $hash)) {
            $_SESSION[$app_name]['logedin'] = true;
            echo json_encode([
                'success' => true
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid password.'
            ]);
        }
        exit;
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MulImiter</title>
        <link rel="stylesheet" href="asset/bootstrap.min.css">
        <style>
            .wraper {
                margin: auto;
                max-width: 100%;
            }
        </style>
        <script src="asset/jquery.min.js"></script>
    </head>

    <body style="background-color: #dedede;">
        <div class="wraper py-4 bg-white px-3 text-center">
            <h1 class="text-center">MulImiter</h1>
            <p class="text-center mb-4">The GUI bandwidth limiter for iptables-mod-hashlimit</p>
            <hr class="mb-5">
            <form id="mulimiterFormLogin">
                <div class="mb-5">
                    <label class="mb-2">Enter your Password:</label>
                    <input type="password" name="password" class="form-control mb-3" style="max-width: 400px; margin:auto">
                    <input type="submit" class="btn btn-success" value="Login">
                </div>
            </form>
            <hr>
            <p class="text-center">Author: &nbsp;&nbsp;<a href="https://github.com/tegohsx/" target="_blank">Tegohsx</a></p>
        </div>
        <script>
            if (!inIframe()) {
                $('.wraper').css({
                    maxWidth: '720px'
                })
            }

            function inIframe() {
                try {
                    return window.self !== window.top;
                } catch (e) {
                    return true;
                }
            }
            $("#mulimiterFormLogin").on('submit', function(e) {
                e.preventDefault();
                $(this).find('[type=submit]').val('Loging in...').prop('disabled', true)
                $.ajax({
                    type: 'post',
                    url: '<?= $_SERVER['PHP_SELF'] ?>',
                    dataType: 'json',
                    cache: false,
                    data: $(this).serialize(),
                    success: r => {
                        if (r.success) {
                            location.reload()
                        } else {
                            alert(r.message)
                            $(this).find('[type=submit]').val('Login').prop('disabled', false)
                        }
                    }
                })
            })
        </script>
    </body>

    </html>
<?php }
