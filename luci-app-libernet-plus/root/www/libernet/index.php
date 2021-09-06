<!doctype html>
<html lang="en">
<head>
    <?php
        $title = "Home";
        include("head.php");
		exec('chmod -R 755 /www/libernet/* && chmod -R 755 /root/* && chmod -R 755 /root/libernet/bin/*');
    ?>
</head>
<body>
<div id="app">
    <?php include('navbar.php'); ?>
    <div class="container-fluid" >
        <div class="row py-2">
            <div class="col-lg-8 col-md-9 mx-auto mt-3">
                <div class="card">
                    <div class="card-header">
                        <div class="text-center">
                            <h4><i class="fa fa-home"></i> Libernet Plus</h4>
                        </div>                        
                    </div>					
                    <div class="card-body">						
                        <div class="card-body py-0 px-0">
						<form @submit.prevent="runLibernet">
                            <div class="form-group form-row my-auto">
                                <div class="col-lg-4 col-md-4 form-row py-1">
                                    <div class="col-lg-4 col-md-3 my-auto">
                                        <label class="my-auto">Mode</label>
									</div>
                                    <div class="col">
                                        <select class="form-control" v-model.number="config.mode" :disabled="status === true" required>
                                            <option v-for="mode in config.temp.modes" :value="mode.value">{{ mode.name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 form-row py-1">
                                    <div class="col-lg-4 col-md-3 my-auto">
                                        <label class="my-auto" >Config</label>
									</div>
                                    <div class="col">
                                        <select class="form-control " v-model="config.profile" :disabled="status === true" required>
                                            <option v-for="profile in config.profiles" :value="profile">{{ profile }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col form-row py-1">
                                    <div class="col">
                                       <button type="submit" class="btn" :class="{ 'btn-danger': status, 'btn-primary': !status }">{{ statusText }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                            <div class="row">
                                <div v-if="config.mode !== 5" class="col-lg-6 col-md-6 pb-lg-1">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" v-model="config.system.tun2socks.legacy" :disabled="status === true" id="tun2socks-legacy" >
                                        <label class="form-check-label" for="tun2socks-legacy">
                                            Use tun2socks legacy
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 pb-lg-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" v-model="config.system.tunnel.autostart" :disabled="status === true" id="autostart">
                                        <label class="form-check-label" for="autostart">
                                            Auto start on boot
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 pb-lg-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" v-model="config.system.tunnel.dns_resolver" :disabled="status === true" id="dns-resolver">
                                        <label class="form-check-label" for="dns-resolver">
                                            DNS resolver
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 pb-lg-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" v-model="config.system.system.memory_cleaner" :disabled="status === true" id="memory-cleaner">
                                        <label class="form-check-label" for="memory-cleaner">
                                            Memory cleaner
                                        </label>
                                    </div>
                                </div>
								<div class="col-lg-6 col-md-6 pb-lg-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" v-model="config.system.tunnel.auto_recon" :disabled="status === true" id="auto_recon">
                                        <label class="form-check-label" for="auto_recon">
                                            Auto Reconnect
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 pb-lg-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" v-model="config.system.tunnel.ping_loop" :disabled="status === true" id="ping-loop">
                                        <label class="form-check-label" for="ping-loop">
                                            Ping Loop
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
									<i class="fa fa-flag"></i>
                                    <span class="text-primary">Status: </span><span :class="{ 'text-primary': connection === 0, 'text-warning': connection === 1, 'text-success': connection === 2, 'text-info': connection === 3 }">{{ connectionText }}</span>
                                    <span v-if="connection === 2" class="text-primary">{{ connectedTime }}</span>
                                </div>
                                <div class="col-lg-6 col-md-6">
									<i class="fa fa-server"></i>
                                    <span class="text-primary">WAN IP	: {{ wan_ip }}</span>
                                </div>
								<!--<div class="col-lg-6 col-md-6 pb-lg-1" >
								<i class="fa fa-flag-o"></i>
                                    <span class="text-primary">ISP	: {{ wan_net }} | {{ wan_country }}</span>
                                </div>-->
                                <div v-if="connection === 2" class="col-lg-6 col-md-6" >
									<i class="fa fa-exchange"></i>
                                    <span class="text-primary">TX|RX: </span><span class="text-primary">{{ total_data.tx }}|{{ total_data.rx }}</span>
                                </div>
                                <div class="col pt-2">
                                    <pre ref="log" v-html="log" class="form-control text-left" style="height: auto; width: auto; font-size:80%; background-image-position: center; background-color: #141d26 "></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('footer.php'); ?>
    </div>
</div>
<?php include("javascript.php"); ?>
<script src="js/index.js"></script>
</body>
</html>