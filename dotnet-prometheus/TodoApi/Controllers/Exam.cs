using Microsoft.AspNetCore.Mvc;
using Prometheus;

namespace TodoApi.Controllers
{
  [ApiController]
  [Route("[controller]")]
  public class ExamController : ControllerBase
  {
    private static readonly Counter ProcessedJobCount = Metrics.CreateCounter("myapp_jobs_processed_total", "Number of processed jobs."); //! Prometheus
    private static readonly Gauge QueueSize = Metrics.CreateGauge("queue_size", "Queue size");

    [HttpGet]
    public string Index()
    {
      return "Exam";
    }

    [HttpGet("Report")]
    public string Report()
    {
      ProcessedJobCount.Inc(); //! Prometheus
      return "Report sent";
    }

    [HttpPut("{count}")]
    public string SetQueueSize(int count)
    {
      QueueSize.Set(count); //! Prometheus
      return "Queue Size has been set";
    }

    [HttpPost]
    public IActionResult Error(){
      return StatusCode(500);
    }
  }
}
