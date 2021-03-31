/* ------------------------------
   TO DO
   Sort stories by date
   ------------------------------ */

var slots = 50;
var defaultTitle = "(Title)";

// -------------------------------------------
// CLASSES
// -------------------------------------------

function App (data) {
  
  // --> { siteUrl, categories, allStories }

  this.siteUrl = data.siteUrl;
  this.allStories = data.allStories;
  this.categories = data.categories;
  this.pagesNum = Math.ceil(this.allStories.length / slots);
  this.state = {
    menuIsOpen: false,
    openStorySlug: null,
    page: 0,
    highlightedCategory: null,
  }
  
  this.toggleMenu = function (open) {
    if(open === true || (open !== false && this.state.menuIsOpen === false)){
      this.state.menuIsOpen = true;
      this.openStory(false);
    } else if (open === false || this.state.menuIsOpen === true){
      this.state.menuIsOpen = false;
      $("body").toggleClass("text-open", false);
    }
    $(".hamburger").toggleClass("is-active", this.state.menuIsOpen);
    $("body").toggleClass("menu-open", this.state.menuIsOpen);
  }

  this.refreshSelection = function () {
    $("#wheel .item").removeClass("selected");
    var slug = this.state.openStorySlug;
    if (slug === null) {
      return;
    }
    var index = undefined;
    currentStories().forEach(function (s, i) {
      if (s.slug === slug) {
        index = i;
        return;
      }
    });
    if (index !== undefined) {
      var svgGroupId = "story-"+ index;
      var item = $("#wheel .item#"+ svgGroupId);
      item.addClass("selected");
    }
  }

  this.openStory = function (slug) {
    // $("#wheel .item").removeClass("selected");
    if (slug === false) {
      this.state.openStorySlug = null;
      $("body").toggleClass("story-open", false);
    } else {
      this.state.openStorySlug = slug;
      $("body").toggleClass("story-open", true);
      this.toggleMenu(false);
      
      // --- Markup
      var story = _.find(this.allStories, { 'slug': slug });
      var markup = templates.story(mapDataToTemplateContext (story, "story"));
      $("#ui-right .content").html(markup);

      // // --- Select in SVG
      // var index;
      // currentStories().forEach(function (s, i) {
      //   if (s.slug === slug) {
      //     index = i;
      //     return;
      //   }
      // });
      // var svgGroupId = "story-"+ index;
      // var item = $("#wheel .item#"+ svgGroupId);
      // item.addClass("selected");

      $(".category-link").removeClass("active");
      $(".category-link[data-cat-id='"+ this.state.highlightedCategory +"']").addClass("active");
      this.refreshSelection();
    }
  }

  this.openPrevStory = function () {
    var that = this;
    var currIndex;
    this.allStories.forEach(function (e, i) {
      if (e.slug === that.state.openStorySlug) {
        currIndex = i;
        return;
      }
    });
    console.log(currIndex);
    var prevIndex = (currIndex == 0)
      ? this.allStories.length - 1
      : currIndex - 1;
    var prevStory = this.allStories[prevIndex];
    

    var page = Math.floor(prevIndex / slots);
    if (page !== this.state.page) {
      this.gotoPage(page);
    }
    this.openStory(prevStory.slug);
  }

  this.openNextStory = function () {
    var that = this;
    var currIndex;
    this.allStories.forEach(function (e, i) {
      if (e.slug === that.state.openStorySlug) {
        currIndex = i;
        return;
      }
    });
    console.log(currIndex);
    var nextIndex = (currIndex >= (this.allStories.length - 1))
      ? 0
      : currIndex + 1;
    var nextStory = this.allStories[nextIndex];
    
    var page = Math.floor(nextIndex / slots);
    if (page !== this.state.page) {
      this.gotoPage(page);
    }
    this.openStory(nextStory.slug);
  }

  this.highlightCategory = function (catSlug, force) {
    $("#wheel .item").removeClass("active");
    $(".category-link").removeClass("active");
    if (this.state.highlightedCategory === catSlug && !force) {
      catSlug = false;
    }
    if (catSlug === false) {
      this.state.highlightedCategory = null;
      $("#wheel-title").html(defaultTitle);
      return;
    }
    var indexes = [];
    currentStories().forEach(function (s, i) {
      if (s.categoriesSlugs.includes(catSlug)) {
        indexes.push(i);
      }
    });
    console.log(indexes);
    indexes.forEach(function (index) {
      var svgGroupId = "story-"+ index;
      var item = $("#wheel .item#"+ svgGroupId);
      item.addClass("active");
    });
    var c = _.find(this.categories, { 'slug': catSlug });
    $("#wheel-title").text(cleanTitle(c.name));
    $(".category-link[data-cat-id='"+ catSlug +"']").addClass("active");
    this.state.highlightedCategory = catSlug;
  }

  this.nextPage = function () {
    if ((this.state.page + 1) < this.pagesNum) {
      this.state.page++;
    }
    if (this.state.highlightedCategory !== null) {
      this.highlightCategory(this.state.highlightedCategory, true);
    }
    this.refreshVisibleStories();
    this.refreshSelection();
    this.refreshPagination();
  }

  this.prevPage = function () {
    if ((this.state.page - 1) >= 0) {
      this.state.page--;
    }
    if (this.state.highlightedCategory !== null) {
      this.highlightCategory(this.state.highlightedCategory, true);
    }
    this.refreshVisibleStories();
    this.refreshSelection();
    this.refreshPagination();
  }

  this.gotoPage = function (n) {
    this.state.page = n;
    if (this.state.highlightedCategory !== null) {
      this.highlightCategory(this.state.highlightedCategory, true);
    }
    this.refreshVisibleStories();
    this.refreshSelection();
    this.refreshPagination();
  }

  this.refreshPagination = function () {
    var from = this.state.page * slots + 1;
    var to = (this.state.page + 1) * slots;
    to = (to > this.allStories.length) ? this.allStories.length : to;
    var text = "Stories "+ from +" — "+ to;
    var arrowNext = (this.state.page + 1) < this.pagesNum;
    var arrowPrev = (this.state.page - 1) >= 0;
    $("#pagination .page-num").text(text);
    $("#pagination .prev").toggleClass("hide", !arrowPrev);
    $("#pagination .next").toggleClass("hide", !arrowNext);
  }

  this.refreshVisibleStories = function () {
    var cs = currentStories();
    var n = cs.length;
    $("#wheel .item").removeClass("nothing");
    if (n < slots) {
      for (var index = n; index < slots; index++) {
        var svgGroupId = "story-"+ index;
        var item = $("#wheel .item#"+ svgGroupId);
        item.addClass("nothing");
      }
    }
  }

  this.openText = function (template) {
    var isSmall = mqSizeOrDown("md");
    this.toggleMenu(!isSmall);

    var markup = templates[template]();
    $("#texts .content").html(markup);
    $("body")
      .toggleClass("story-open", false)
      .toggleClass("text-open", true);

  }

  this.reset = function () {
    this.gotoPage(0);
    this.toggleMenu(false);
    this.openStory(false);
    this.highlightCategory(false);
    $("#wheel .item").removeClass("selected");
    $("body").toggleClass("text-open", false);
  }
}

// -------------------------------------------
// FUNCTIONS
// -------------------------------------------

function currentStories () {
  return a.allStories.slice(slots * a.state.page, slots * (a.state.page + 1));
}

function handleNavCategoryClick (catSlug) {
  $("body").toggleClass("text-open", false);
  a.highlightCategory(catSlug);
  if (mqSizeOrDown("md")) {
    a.toggleMenu(false);
  }
}

function handleStoryCategoryClick (catSlug) {
  if (mqSizeOrDown("md")) {
    a.highlightCategory(catSlug, true);
    a.openStory(false);
  } else {
    a.highlightCategory(catSlug);
  }
}

function mqSizeOrDown (bootstrapSize) {
  var breakpoints = {
    "xs": 575 - 0.01,
    "sm": 768 - 0.01,
    "md": 992 - 0.01,
    "lg": 1200 - 0.01,
  };
  var s = breakpoints[bootstrapSize];
  var mq = window.matchMedia( "(max-width: "+ s +"px)" );
  return mq.matches;
}

function mqSizeOrUp (bootstrapSize) {
  var breakpoints = {
    "sm": 575,
    "md": 768,
    "lg": 992,
    "xl": 1200,
  };
  var s = breakpoints[bootstrapSize];
  return window.matchMedia( "(min-width: "+ s +"px)" ).matches;
}

function cleanTitle (string) {
  if (string === "Efficient/Motivating") return "Efficient​/​Motivating";
  if (string === "Inefficient/Demotivating") return "Inefficient​/​Demotivating";
  return string;
}

// -------------------------------------------
// EVENTS
// -------------------------------------------

$("#wheel .item").click(function () {
  var groupId = $(this).attr("id");
  var index = +groupId.substr("story-".length);
  var s = currentStories()[index];
  console.log(s);
  a.openStory(s.slug);
});

// -------------------------------------------
// KEY BINDINGS
// -------------------------------------------

document.addEventListener('keyup', function (event) {
  if (event.defaultPrevented) {
    return; 
  }
  var key = event.key || event.keyCode;
  if (key === 'Escape' || key === 'Esc' || key === 27) {
    a.openStory(false);
    a.toggleMenu(false);
  }
});

// -------------------------------------------
// ON READY
// -------------------------------------------

$(document).ready(function () {
});




