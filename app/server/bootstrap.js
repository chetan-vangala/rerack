Meteor.startup(function () {
  if (Meteor.users.find().count() === 0) {
     var u = Accounts.createUser({
      'email' : 'admin@rerack.it',
      'password' : 'rerackit',
      'username': 'rerack',
      'profile': {
        'name': 'Rerack Admin'
      }
    });
    console.log('admin user created', u);
  }
});
