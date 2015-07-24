Schema.table = new SimpleSchema({
  title: {
    type: String,
    label: "Name",
    optional: true,
    max: 100
  },
  ownerId: {
    type: String
  },
  visibility: {
    type: String,
    allowedValues: ['public', 'unlisted', 'private']
  },
  creationDate: {
    type: Date,
    autoValue: function() {
      if (this.isInsert) {
        return new Date();
      }
    }
  },
  location: {
    type: Schema.location
  }
});
