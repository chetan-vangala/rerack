FindController = RouteController.extend({
  onBeforeAction: function() {
    this.render('Loading');
    if (Geolocation.latLng()) {
      this.next();
    }
  },  
  waitOn: function () {
  },
  data: function () {
  },
  action: function () {
    this.render();
  }
});