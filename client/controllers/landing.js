LandingController = RouteController.extend({
  waitOn: function () {
    //return Meteor.subscribe('invites');
  },

  data: function () {
    //return Invites.find();
  },

  action: function () {
    this.render();
  }
});