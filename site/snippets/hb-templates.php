<?php
$assets = $kirby->url("assets");

$about = page("about");
$aboutTitle = $about->title();
$aboutText = $about->text()->kt();

$privacy = page("privacy");
$privacyTitle = $privacy->title();
$privacyText = $privacy->text()->kt();
?>

<!-- Handlebars templates -->
<!-- https://www.youtube.com/watch?v=3zVYH16yogQ -->


<script id="template-story" type="text/x-handlebars-template">

{{!-------------------
  template "story"
  --------------------
  story object
  --------------------}}

  <div class="story my-space-2">
    <p class="nav my-space">
      <a class="color-purple" onclick="a.openPrevStory();">&larr; Previous</a>
      <a class="color-purple mx-space" onclick="a.openStory(false);">Hide</a>
      <a class="color-purple" onclick="a.openNextStory();">Next &rarr;</a>
    </p>
    <h1 class="font-sans-l">{{title}}</h1>
    <p class="my-space">
      {{#each categoriesArray}}
        <a 
          class="category-label category-link" 
          data-cat-id="{{this.slug}}" 
          onclick="handleStoryCategoryClick('{{this.slug}}')"
        >{{this.name}}</a>
      {{/each}}
    </p>
    <p class="font-serif-m">
      {{text}}
    </p>
    <p class="font-sans-m my-space">
      Contributed by {{author}}. {{place}} {{!--, {{dateFormatted}} --}}
    </p>
    <p class="spacer" style="height: 120px;"></p>
  </div>

</script>

<script id="template-about" type="text/x-handlebars-template">

{{!-------------------
  template "about"
  --------------------
  --------------------}}

  <div class="my-space-2">
    <p class="my-space-2">
      <h2 class="font-serif-m upper"><?= $aboutTitle ?></h2>
    </p>
    <p class="my-space-2">
      <img src="<?= $assets ?>/images/circle__legend.svg" width="100%" />
    </p>
    <div class="kt font-serif-m">
      <?= $aboutText ?>
    </div>

    <p class="spacer" style="height: 50px;"></p>

    <h2 class="font-sans-m mb-2">CREDITS</h2>

    <div class="credits">
      <p>
        <a href="https://www.linkedin.com/in/bethaltringer/" target="_blank">Dr. Beth Altringer, Harvard University</a>
        <br />Principal Investigator (Study Design/Data Collection/Quantitative & Qualitative Research Lead)
      </p>
      <p>
        <a href="https://twitter.com/fedfragapane" target="_blank">Federica Fragapane</a>
        <br />Data Visualization Lead
      </p>
      <p>
        <a href="https://alexpiacentini.com" target="_blank">Alex Piacentini</a>
        <br />Web Design Lead and Web Development
      </p>
      <p>
        <em>Ilia Barantchouk</em>
        <br />Quantitative Research Assistance
      </p>
      <p>
        <em>Laurie Delaney, Harvard University</em>
        <br />Qualitative Research Assistance (Tagging Lead and First Rater)
      </p>
      <p>
        <em>Jared Meyers, Harvard University</em>
        <br />Qualitative Research Assistance (Tagging Second Rater)
      </p>
    </div>

    <p class="spacer" style="height: 100px;"></p>
  </div>

</script>

<script id="template-privacy" type="text/x-handlebars-template">

{{!-------------------
  template "privacy"
  --------------------
  --------------------}}

  <div class="my-space-2">
    <h2 class="font-serif-m upper"><?= $privacyTitle ?></h2>
    <div class="kt font-serif-m">
      <?= $privacyText ?>
    </div>
    <p class="spacer" style="height: 120px;"></p>
  </div>

</script>

<script>

var templates = {
  "story":    Handlebars.compile($("#template-story").html()),
  "about":    Handlebars.compile($("#template-about").html()),
  "privacy":  Handlebars.compile($("#template-privacy").html()),
};

function mapDataToTemplateContext (data, template) {
  if (template == "story") {
    var categoriesArray = data.categoriesSlugs.map(function (e, i) {
      return { slug: e, name: data.categories[i] }
    });
    var sortedCategoriesArray = _.sortBy(categoriesArray, function (e) {
      return e.slug;
    });
    var d = new Date(Date.parse(data.storyDate));
    var months = [
      "January",
      "February",
      "March",
      "April",
      "May",
      "June",
      "July",
      "August",
      "September",
      "October",
      "November",
      "December",
    ];
    var dateFormatted = d.getDate() +" "+ months[d.getMonth()] +" "+ d.getFullYear();
    data.categoriesArray = sortedCategoriesArray;
    data.dateFormatted = dateFormatted;
    return data;
  }
}

</script>

<!-- Templates end -->