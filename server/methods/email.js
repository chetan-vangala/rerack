Meteor.methods({
  sendEmail: function (email) {
    check([email], [String]);
    this.unblock();
    
    var body = Handlebars.templates['invite']({email: email});

    Email.send({
      to: email,
      from: 'ReRack <list@rerackapp.com>',
      subject: 'Thanks for your interest in ReRack',
      html: body
    });
  }
});