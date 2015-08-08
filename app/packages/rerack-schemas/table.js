Schema.table = new SimpleSchema({
  creationDate: timestamp,
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
  location: {
    type: Schema.location
  }
});
