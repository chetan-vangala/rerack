/*****************************************************************************/
/* Cast: Event Handlers and Helpersss .js*/
/*****************************************************************************/
Template.Cast.events({
  /*
   * Example:
   *  'click .selector': function (e, tmpl) {
   *
   *  }
   */
});

Template.Cast.helpers({
  /*
   * Example:
   *  items: function () {
   *    return Items.find();
   *  }
   */
});

/*****************************************************************************/
/* Cast: Lifecycle Hooks */
/*****************************************************************************/
Template.Cast.created = function () {
};

Template.Cast.rendered = function () {
  var clock = $('.flipclock').FlipClock({
    clockFace: 'TwelveHourClock'
  });
};

Template.Cast.destroyed = function () {
};