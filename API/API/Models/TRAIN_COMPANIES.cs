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
    
    public partial class TRAIN_COMPANIES
    {
        [System.Diagnostics.CodeAnalysis.SuppressMessage("Microsoft.Usage", "CA2214:DoNotCallOverridableMethodsInConstructors")]
        public TRAIN_COMPANIES()
        {
            this.CARRIAGES = new HashSet<CARRIAGE>();
            this.TRAINS = new HashSet<TRAIN>();
        }
    
        public int ID { get; set; }
        public string COMPANY_NAME { get; set; }
        public string LOGO { get; set; }
    
        [System.Diagnostics.CodeAnalysis.SuppressMessage("Microsoft.Usage", "CA2227:CollectionPropertiesShouldBeReadOnly")]
        public virtual ICollection<CARRIAGE> CARRIAGES { get; set; }
        [System.Diagnostics.CodeAnalysis.SuppressMessage("Microsoft.Usage", "CA2227:CollectionPropertiesShouldBeReadOnly")]
        public virtual ICollection<TRAIN> TRAINS { get; set; }
    }
}