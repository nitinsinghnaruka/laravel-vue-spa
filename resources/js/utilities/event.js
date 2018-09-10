class Event {
  /**
   * Create a new Event instance.
   */
  constructor() {
    this.vue = new Vue();
  }

  /**
   * Fire an event.
   * 
   * @param {string} event 
   * @param {*|null} data 
   */
  fire(event, data = null) {
    this.vue.$emit(event, data);
  }

  /**
   * Listen to an event.
   * 
   * @param {string} event 
   * @param {*}      callback 
   */
  listen(event, callback) {
    this.vue.$on(event, callback);
  }
}

export default Event;
