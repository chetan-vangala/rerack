Schema = {};

timestamp = {
  type: Date,
  autoValue: function() {
    if (this.isInsert) {
      return new Date();
    }
  }
};
