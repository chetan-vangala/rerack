/*****************************************************************************/
/* Find: Event Handlers and Helpersss .js*/
/*****************************************************************************/
Template.Find.events({
  /*
   * Example:
   *  'click .selector': function (e, tmpl) {
   *
   *  }
   */
});

Template.Find.helpers({
  location: function () {
    var loc = Geolocation.latLng();
    console.log(loc);
    return loc;
  }
});

/*****************************************************************************/
/* Find: Lifecycle Hooks */
/*****************************************************************************/
Template.Find.created = function () {
};

Template.Find.rendered = function () {
};

Template.Find.destroyed = function () {
};