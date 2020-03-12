class Request {

  async post(url, postData) {
    try {
      const response = await fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(postData),
      });

      const data = await response.json();

      if (response.ok === false) {
        throw new Error(data.message);
      }

      return data;

    } catch (error) {
      throw new Error(error);
    }
  }

  async addBrewery(record) {
    try {
      return await this.post('/.netlify/functions/addBrewery', record);
    } catch (error) {
      throw new Error(error);
    }
  }
}

export default Request;
