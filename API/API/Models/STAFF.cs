//------------------------------------------------------------------------------
// <auto-generated>
//     This code was generated from a template.
//
//     Manual changes to this file may cause unexpected behavior in your application.
//     Manual changes to this file will be overwritten if the code is regenerated.
// </auto-generated>
//------------------------------------------------------------------------------

namespace API.Models
{
    using System;
    using System.Collections.Generic;
    
    public partial class STAFF
    {
        [System.Diagnostics.CodeAnalysis.SuppressMessage("Microsoft.Usage", "CA2214:DoNotCallOverridableMethodsInConstructors")]
        public STAFF()
        {
            this.TRAIN_JOURNEY_STAFF = new HashSet<TRAIN_JOURNEY_STAFF>();
        }
    
        public int ID { get; set; }
        public string EMAIL_ADDRESS { get; set; }
        public string PASSWORD { get; set; }
        public string FIRST_NAME { get; set; }
        public string LAST_NAME { get; set; }
        public System.DateTime DATE_OF_BIRTH { get; set; }
        public string GENDER { get; set; }
        public string STAFF_ROLE { get; set; }
        public string PHOTO { get; set; }
    
        [System.Diagnostics.CodeAnalysis.SuppressMessage("Microsoft.Usage", "CA2227:CollectionPropertiesShouldBeReadOnly")]
        public virtual ICollection<TRAIN_JOURNEY_STAFF> TRAIN_JOURNEY_STAFF { get; set; }
    }
}
