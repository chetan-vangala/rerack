Meteor.methods({
  sendEmail: function (email) {
    check([email], [String]);
    this.unblock();

    console.log('sendEmail', email);

    var body = Handlebars.templates['confirm']({email: email});

    Email.send({
      to: email,
      from: 'rerack <list@rerackapp.com>',
      subject: 'Confirm Your Email Address',
      html: body
    });
  }
});
