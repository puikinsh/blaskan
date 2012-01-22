google.load("feeds", "1");

function blaskan_forum_posts() {
  var feed = new google.feeds.Feed("http://wordpress.org/support/rss/tags/blaskan");
  feed.load(function(result) {
    if (!result.error) {
      var container = document.getElementById("blaskan-forum-posts");
      for (var i = 0; i < result.feed.entries.length; i++) {
        var entry = result.feed.entries[i];
        var div = document.createElement("div");
        div.appendChild(document.createTextNode(entry.title));
        container.appendChild(div);
      }
    }
  });
}
google.setOnLoadCallback(blaskan_forum_posts);
