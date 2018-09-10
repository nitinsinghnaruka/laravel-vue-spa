class Auth {
  /**
   * Store.
   * store auth data to local storage.
   * 
   * @param {*} token
   * @param {*} user
   */
  store(token, user) {
    // Store token.
    localStorage.setItem('token', token);

    // Store user.
    localStorage.setItem('user', JSON.stringify(user));

    return;
  }

  /**
   * Clear.
   * clear auth data from local storage.
   */
  clear() {
    // Remove token.
    localStorage.removeItem('token');

    // Remove user.
    localStorage.removeItem('user');

    return;
  }
}

export default Auth;
