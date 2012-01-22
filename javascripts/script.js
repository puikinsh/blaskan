google.load("feeds", "1");

function blaskan_forum_posts() {
  var feed = new google.feeds.Feed("http://wordpress.org/support/rss/tags/blaskan");
  feed.setNumEntries(5);

  feed.load(function(result) {
    if (!result.error) {
      var container = document.getElementById("blaskan-forum-posts");
      var html = '<ul>';

      for (var i = 0; i < result.feed.entries.length; i++) {
        var entry = result.feed.entries[i];
        html += '<li><a href="' + entry.url + '">' + entry.title + '</a><br>' + entry.contentSnippet + '</li>';
      }

      html += '</ul>'

      container.innerHTML = html;
    }
  });
}
google.setOnLoadCallback(blaskan_forum_posts);
