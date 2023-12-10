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
    public class TRAIN_COMPANIESController : ApiController
    {
        private Entities2 db = new Entities2();

        // GET: api/TRAIN_COMPANIES
        public IQueryable<TRAIN_COMPANIES> GetTRAIN_COMPANIES()
        {
            db.Configuration.ProxyCreationEnabled = false;
            return db.TRAIN_COMPANIES;
        }

        // GET: api/TRAIN_COMPANIES/5
        [ResponseType(typeof(TRAIN_COMPANIES))]
        public IHttpActionResult GetTRAIN_COMPANIES(int id)
        {
            db.Configuration.ProxyCreationEnabled = false;

            TRAIN_COMPANIES tRAIN_COMPANIES = db.TRAIN_COMPANIES.Find(id);
            if (tRAIN_COMPANIES == null)
            {
                return NotFound();
            }

            return Ok(tRAIN_COMPANIES);
        }

        // PUT: api/TRAIN_COMPANIES/5
        [ResponseType(typeof(void))]
        public IHttpActionResult PutTRAIN_COMPANIES(int id, TRAIN_COMPANIES tRAIN_COMPANIES)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            if (id != tRAIN_COMPANIES.ID)
            {
                return BadRequest();
            }

            db.Entry(tRAIN_COMPANIES).State = EntityState.Modified;

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!TRAIN_COMPANIESExists(id))
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

        // POST: api/TRAIN_COMPANIES
        [ResponseType(typeof(TRAIN_COMPANIES))]
        public IHttpActionResult PostTRAIN_COMPANIES(TRAIN_COMPANIES tRAIN_COMPANIES)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            db.TRAIN_COMPANIES.Add(tRAIN_COMPANIES);

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateException)
            {
                if (TRAIN_COMPANIESExists(tRAIN_COMPANIES.ID))
                {
                    return Conflict();
                }
                else
                {
                    throw;
                }
            }

            return CreatedAtRoute("DefaultApi", new { id = tRAIN_COMPANIES.ID }, tRAIN_COMPANIES);
        }

        // DELETE: api/TRAIN_COMPANIES/5
        [ResponseType(typeof(TRAIN_COMPANIES))]
        public IHttpActionResult DeleteTRAIN_COMPANIES(int id)
        {
            TRAIN_COMPANIES tRAIN_COMPANIES = db.TRAIN_COMPANIES.Find(id);
            if (tRAIN_COMPANIES == null)
            {
                return NotFound();
            }

            db.TRAIN_COMPANIES.Remove(tRAIN_COMPANIES);
            db.SaveChanges();

            return Ok(tRAIN_COMPANIES);
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }

        private bool TRAIN_COMPANIESExists(int id)
        {
            return db.TRAIN_COMPANIES.Count(e => e.ID == id) > 0;
        }
    }
}