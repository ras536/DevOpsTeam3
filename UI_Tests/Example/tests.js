  QUnit.test("prettydate.format", function( assert ) {
    function date(then, expected) {
      assert.equal(prettyDate.format("2008/01/28 22:25:00", then),
        expected);
    }
    date("2008/01/28 22:24:30", "just now");
    date("2008/01/28 22:23:30", "1 minute ago");
    date("2008/01/28 21:23:30", "1 hour ago");
    date("2008/01/27 22:23:30", "Yesterday");
    date("2008/01/26 22:23:30", "2 days ago");
    date("2007/01/26 22:23:30", undefined);
  });
 
  QUnit.test("prettyDate.update", function( assert ) {
    var links = document.getElementById("qunit-fixture")
      .getElementsByTagName("a");
    assert.equal(links[0].innerHTML, "January 28th, 2008");
    assert.equal(links[2].innerHTML, "January 27th, 2008");
    prettyDate.update("2008-01-28T22:25:00Z");
    assert.equal(links[0].innerHTML, "2 hours ago");
    assert.equal(links[2].innerHTML, "Yesterday");
  });
 
  QUnit.test("prettyDate.update, one day later", function( assert ) {
    var links = document.getElementById("qunit-fixture")
      .getElementsByTagName("a");
    assert.equal(links[0].innerHTML, "January 28th, 2008");
    assert.equal(links[2].innerHTML, "January 27th, 2008");
    prettyDate.update("2008/01/29 22:25:00");
    assert.equal(links[0].innerHTML, "Yesterday");
    assert.equal(links[2].innerHTML, "2 days ago");
  });