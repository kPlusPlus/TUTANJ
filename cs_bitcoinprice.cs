string json;

using (var web = new System.Net.WebClient())
{
	var url = @"https://api.coindesk.com/v1/bpi/currentprice.json";
	json = web.DownloadString(url);
}

dynamic obj = Newtonsoft.Json.JsonConvert.DeserializeObject(json);
var currentPrice = Convert.ToDecimal(obj.bpi.USD.rate.Value);

Console.WriteLine(currentPrice);