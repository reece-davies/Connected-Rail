using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Data.Entity.Infrastructure;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;
using System.Web.Http.Cors;
using System.Web.Http.Description;
using API.Models;

namespace API.Controllers
{
    [EnableCors(origins: "*", headers: "*", methods: "*")] // tune to your needs
    [RoutePrefix("")]
    public class TRAIN_JOURNEYController : ApiController
    {
        private Entities2 db = new Entities2();

        // GET: api/TRAIN_JOURNEY
        public IQueryable<TRAIN_JOURNEY> GetTRAIN_JOURNEY()
        {
            db.Configuration.ProxyCreationEnabled = false;
            return db.TRAIN_JOURNEY;
        }

        // GET: api/TRAIN_JOURNEY/5
        [ResponseType(typeof(TRAIN_JOURNEY))]
        public IHttpActionResult GetTRAIN_JOURNEY(int id)
        {
            db.Configuration.ProxyCreationEnabled = false;

            TRAIN_JOURNEY tRAIN_JOURNEY = db.TRAIN_JOURNEY.Find(id);
            if (tRAIN_JOURNEY == null)
            {
                return NotFound();
            }

            return Ok(tRAIN_JOURNEY);
        }

        // PUT: api/TRAIN_JOURNEY/5
        [ResponseType(typeof(void))]
        public IHttpActionResult PutTRAIN_JOURNEY(int id, TRAIN_JOURNEY tRAIN_JOURNEY)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            if (id != tRAIN_JOURNEY.ID)
            {
                return BadRequest();
            }

            db.Entry(tRAIN_JOURNEY).State = EntityState.Modified;

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!TRAIN_JOURNEYExists(id))
                {
                    return NotFound();
                }
                else
                {
                    throw;
                }
            }

            return StatusCode(HttpStatusCode.NoContent);
        }

        // POST: api/TRAIN_JOURNEY
        [ResponseType(typeof(TRAIN_JOURNEY))]
        public IHttpActionResult PostTRAIN_JOURNEY(TRAIN_JOURNEY tRAIN_JOURNEY)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            db.TRAIN_JOURNEY.Add(tRAIN_JOURNEY);

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateException)
            {
                if (TRAIN_JOURNEYExists(tRAIN_JOURNEY.ID))
                {
                    return Conflict();
                }
                else
                {
                    throw;
                }
            }

            return CreatedAtRoute("DefaultApi", new { id = tRAIN_JOURNEY.ID }, tRAIN_JOURNEY);
        }

        // DELETE: api/TRAIN_JOURNEY/5
        [ResponseType(typeof(TRAIN_JOURNEY))]
        public IHttpActionResult DeleteTRAIN_JOURNEY(int id)
        {
            TRAIN_JOURNEY tRAIN_JOURNEY = db.TRAIN_JOURNEY.Find(id);
            if (tRAIN_JOURNEY == null)
            {
                return NotFound();
            }

            db.TRAIN_JOURNEY.Remove(tRAIN_JOURNEY);
            db.SaveChanges();

            return Ok(tRAIN_JOURNEY);
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }

        private bool TRAIN_JOURNEYExists(int id)
        {
            return db.TRAIN_JOURNEY.Count(e => e.ID == id) > 0;
        }
    }
}