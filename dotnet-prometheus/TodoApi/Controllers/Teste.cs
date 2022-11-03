using Microsoft.AspNetCore.Mvc;

namespace TodoApi.Controllers
{
  [ApiController]
  [Route("[controller]")]
  public class TesteController : ControllerBase
  {
  [HttpGet]
    public string Index()
    {
      return "Teste";
    }

  [HttpGet("Report")]
    public string Report()
    {
      return "Report sent";
    }
  }
}
