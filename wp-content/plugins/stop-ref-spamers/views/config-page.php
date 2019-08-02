<style type="text/css" xmlns="http://www.w3.org/1999/html">
    p.wsrs__blacklist_info {
        display: block;
    }
    ul.wsrs__blacklist {
        display: none;
        list-style: decimal;
        width: 50%;
    }
    ul.wsrs__blacklist li {
        margin: 2px 2px 2px 30px;
        padding: 1px 5px;
    }
    ul.wsrs__blacklist li:nth-child(odd) {
        background-color: #fff;
    }
    div.wsrs__container {
        width: 90%;
        padding: 0;
        margin: 0;
    }
    div.wsrs__container textarea {
        width:100%;
    }
    div.wsrs__column {
        padding: 20px 30px 20px 0;
        float: left;
    }
</style>

<div id="fb-root"></div>
<script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8&appId=133716633313685";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>

<div class="wrap">

    <h2>Stop Referral Spam</h2>

    <?php if(WSRS_Helper::get('force_refresh')): ?>
        <?php _e( $data['refresh_message'] ); ?>
    <?php endif; ?>
    <?php if($data['save_message']): ?>
        <?php _e( $data['save_message'] ); ?>
    <?php endif; ?>

    <div class="wsrs__container">
        <div class="wsrs__column" style="width: 55%;">
            <h3>Information</h3>

            <p>
                List is updated twice a day. Next update is scheduled @ <?php echo WSRS_Helper::getNextUpdateTime(true) ?>&nbsp;
                <a class="button button-primary" href="<?php echo WSRS_Helper::url(array('force_refresh' => 1)) ?>">Refresh now</a>
            </p>

            <h4>Custom URLs</h4>
            <p>Insert only <strong><u>one</u></strong> URL per line.<br />
                Add only high level URL. For example, if you see referrer like
                this in your statistics: <i>claim53693832.copyrightclaims.org</i>,
                add only <i><u>copyrightclaims.org</u></i>.<br />
                Each Custom URL works like a wildcard. Every sub-domain of the URL
                that you set up here, will be blocked. For example, if you put <i>i-spam.com</i> on the list,
                it will block <i>everything.i-spam.com</i> too, as well as <i>low.level.sub-domain.i-spam.com.</i><br />
                <br />
                <strong>Important:</strong> please be <u>very</u> careful what you add here, any traffic from URLs on this list will be blocked.
            </p>
            <div>
                <form method="post" action="<?php echo WSRS_Helper::plugin_admin_page_url() ?>">
                    <textarea name="custom_urls" cols="60" rows="6"><?php echo $data['custom_urls']; ?></textarea>
                    <br />
                    <input type="submit" value="Save" class="button button-primary" />
                </form>
            </div>
        </div>
        <div class="wsrs__column" style="width: 35%;">
            <h3>Reviews & social</h3>

            <h4>Please review</h4>

            <p>Make my plugin better by reviewing it!
                <a href="https://wordpress.org/support/plugin/stop-referrer-spam/reviews#new-post" target="_blank"><strong style="font-size:20px;">Here</strong></a> you
                can write a review and rate this plugin. Let know other people how awesome it is ;)<br />
                <br />
                Thank you <strong>very</strong> much!
            </p>

            <h4>Spread the word!</h4>

            <p>Share information about this plugin with your friends on social media!</p>
            <p>
                <div class="fb-share-button" data-href="https://wordpress.org/plugins/stop-referrer-spam/" data-layout="button" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwordpress.org%2Fplugins%2Fstop-referrer-spam%2F&amp;src=sdkpreparse">Share</a></div>

                <a target="_blank" href="https://twitter.com/home?status=I%20found%20a%20way%20to%20fight%20referrer%20spam%20with%20this%20cool%20plugin%20https%3A//wordpress.org/plugins/stop-referrer-spam/">Share on Twitter</a>
            </p>

        </div>

    </div>

    <div style="clear: both;"></div>

    <h3 id="wsrs-blacklist">Current blacklist sources:</h3>
    <p>
        &bull; <a href="<?php echo WSRS_Config::WSRS_BLACKLIST_SOURCE_WEBSITE ?>" target="_blank">Piwik's referrer-spam-blacklist</a><br />
    </p>
    <p>
        To add a new URL to the global list please have a look at
        <a target="_blank" href="https://github.com/piwik/referrer-spam-blacklist#contributing">Contributing section in Piwik's repository</a>.
    </p>

    <h3>
        Current blacklist: <a id="wsrs__toggle" href="#wsrs-blacklist">expand</a>&nbsp;&nbsp;
        Search for url: <input id="wsrs-search-spammer" type="text" /> [<span id="wsrs-search-spammer-found"></span>]
    </h3>
    <p class="wsrs__blacklist_info">There is <strong><?php echo count($data['blacklist']) ?></strong> blacklisted URLs right now.</p>
    <ul class="wsrs__blacklist"></ul>
</div>


<script>
  var blacklistJSON = <?php echo json_encode($data['blacklist']); ?>;
  (function () {
    var getByClass = function (className) {
      return document.getElementsByClassName(className)[0];
    };
    var getById = function (elId) {
      return document.getElementById(elId);
    };
    var toggleBtn = getById("wsrs__toggle"),
      searchInput = getById('wsrs-search-spammer'),
      list = getByClass("wsrs__blacklist"),
      info = getByClass("wsrs__blacklist_info");

    var length = function (collection) {
      if (Array.isArray(collection)) {
        return collection.length;
      }
      return Object.keys(collection).length;
    };
    var refreshBlacklist = function (blacklist) {
      var blacklistLength = length(blacklist);
      getById("wsrs-search-spammer-found").innerText = blacklistLength;
      while (list.firstChild) {
        list.removeChild(list.firstChild);
      }
      if (blacklistLength) {
        for (var i=0; i<blacklistLength; i++) {
          var element = document.createElement("li");
          element.innerText = blacklist[i];
          list.appendChild(element);
        }
      }
      else {
        var element = document.createElement("p");
        element.innerText = "Found nothing :(";
        list.appendChild(element);
      }
    };
    var toggleList = function () {
      if (list.style.display === "block") {
        info.style.display = "block";
        list.style.display = "none";
        toggleBtn.text = "expand";
        searchInput.value = "";
        refreshBlacklist(blacklistJSON);
      }
      else {
        info.style.display = "none";
        list.style.display = "block";
        toggleBtn.text = "collapse";
      }
    };
    var search = function () {
      var searchPhrase = searchInput.value,
        filteredBlacklist = [],
        pat = new RegExp(searchPhrase, "g"),
        blacklistLength = length(blacklistJSON);
      if (list.style.display === "none" || list.style.display === "") {
        toggleList();
      }
      for (var i=0; i<blacklistLength; i++) {
        if (blacklistJSON[i].match(pat) !== null) {
          filteredBlacklist.push(blacklistJSON[i]);
        }
      }
      refreshBlacklist(filteredBlacklist);
      getById("wsrs-blacklist").scrollIntoView();
    };

    refreshBlacklist(blacklistJSON);
    toggleBtn.addEventListener("click", toggleList, true);
    searchInput.addEventListener('keyup', search, true);
  })();
</script>








