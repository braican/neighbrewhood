const fetch = require('node-fetch');
const fs = require('fs');

const getBreweries = city => {
  const breweries = [];
  let page = 1;

  const getPage = () => new Promise((resolve, reject) => {
    fetch(`https://api.openbrewerydb.org/breweries?by_city=${city}&page=${page}&sort=name&per_page=50`)
      .then(res => res.json())
      .then(data => {
        breweries.push(...data);
        if (data.length === 50) {
          page += 1;
          resolve(getPage());
        } else {
          resolve(breweries);
        }
      })
      .catch(error => {
        console.log('error in getPage');
        reject(error);
      });
  });

  return Promise.resolve(getPage());
};

const init = async () => {
  const cityArgs = process.argv.filter(arg => arg.indexOf('--city=') === 0);
  const city = cityArgs.length > 0 ? encodeURIComponent(cityArgs[0].replace('--city=', '')) : null;

  if (!city) {
    console.error('This command requires a city.');
    process.exit(1);
  }

  try {
    const breweries = await getBreweries(city);
    fs.writeFileSync('./test.txt', JSON.stringify(breweries));
  } catch (error) {
    console.error(error);
    process.exit(1);
  }
};

init();