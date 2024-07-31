    function changeView() {

        var signInBox = document.getElementById("signInBox");
        var signUpBox = document.getElementById("signUpBox");

        signInBox.classList.toggle("d-none");
        signUpBox.classList.toggle("d-none");

    }

    function signup() {

        var fname = document.getElementById("fname");
        var lname = document.getElementById("lname");
        var email = document.getElementById("email");
        var password = document.getElementById("password");
        var mobile = document.getElementById("mobile");
        var gender = document.getElementById("gender");

        var f = new FormData();
        f.append("fname", fname.value);
        f.append("lname", lname.value);
        f.append("email", email.value);
        f.append("password", password.value);
        f.append("mobile", mobile.value);
        f.append("gender", gender.value);

        var r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            if (r.readyState == 4) {

                var text = r.responseText;

                if (text == "success") {
                    alert(text);

                    fname.value = "";
                    lname.value = "";
                    email.value = "";
                    mobile.value = "";
                    password.value = "";
                    document.getElementById("msg").innerHTML = "";
                    changeView();

                } else {
                    document.getElementById("msg").innerHTML = text;
                }

            }
        };

        r.open("POST", "signupprocess.php", true);
        r.send(f);
    }

    function signIn() {

        var email = document.getElementById("email2");
        var password = document.getElementById("password2");
        var remember = document.getElementById("remember");


        var form = new FormData();
        form.append("email", email.value);
        form.append("password", password.value);
        form.append("remember", remember.checked);

        var r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            if (r.readyState == 4) {

                var t = r.responseText;

                if (t == "success") {

                    alert(t);
                    window.location = "home.php";

                } else {
                    document.getElementById("msg2").innerHTML = t;

                }

            }
        };

        r.open("POST", "signInprocess.php", true);
        r.send(form);

    }

    var bm;

    function ForGotPassword() {

        var email = document.getElementById("email2");

        var r = new XMLHttpRequest();
        r.onreadystatechange = function() {

            if (r.readyState == 4) {

                var text = r.responseText;
                if (text == "success") {
                    alert("verification email sent . please check your email");
                    var m = document.getElementById("ForgetPasswordModel");
                    bm = new bootstrap.Modal(m);
                    bm.show();

                } else {
                    alert(text);

                }
            }

        };

        r.open("GET", "forgotpasswordprocess.php?e=" + email.value, true);
        r.send();
    }

    function showpassword1() {

        var np = document.getElementById("np");
        var npb = document.getElementById("npb");

        if (npb.innerHTML == "Show") {
            np.type = "text";
            npb.innerHTML = "Hide";

        } else {
            np.type = "password";
            npb.innerHTML = "Show";
        }

    }


    function showpassword2() {

        var rp = document.getElementById("rnp");
        var rpb = document.getElementById("rpb");

        if (rpb.innerHTML == "Show") {
            rp.type = "text";
            rpb.innerHTML = "Hide";

        } else {
            rp.type = "password";
            rpb.innerHTML = "Show";
        }

    }

    function resetpassword() {

        var e = document.getElementById("email2");
        var np = document.getElementById("np");
        var rnp = document.getElementById("rnp");
        var vc = document.getElementById("vc");

        var form = new FormData();
        form.append("e", e.value);
        form.append("np", np.value);
        form.append("rnp", rnp.value);
        form.append("vc", vc.value);

        var r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var text = r.responseText;
                if (text == "success") {
                    alert("Password Reset Success");

                    bm.hide();

                } else {
                    alert(text);
                }

            }
        };

        r.open("POST", "resetpassword.php", true);
        r.send(form);
    }

    function gotoaddproduct() {
        window.location = "addproduct.php";
    }

    function changeimg() {
        var image = document.getElementById("imguploader");
        var view = document.getElementById("prev");

        image.onchange = function() {
            var file = this.files[0];
            var url = window.URL.createObjectURL(file);

            view.src = url;
        }
    }

    function addproduct() {

        var category = document.getElementById("ca");
        var brand = document.getElementById("br");
        var model = document.getElementById("mo");
        var title = document.getElementById("ti");
        var condition;

        if (document.getElementById("bn").checked) {
            condition = 1;
        } else if (document.getElementById("us").checked) {
            condition = 2;
        }

        var colour;

        if (document.getElementById("clr1").checked) {
            colour = 1;
        } else if (document.getElementById("clr2").checked) {
            colour = 2;
        } else if (document.getElementById("clr3").checked) {
            colour = 3;
        } else if (document.getElementById("clr4").checked) {
            colour = 4;
        } else if (document.getElementById("clr5").checked) {
            colour = 5;
        } else if (document.getElementById("clr6").checked) {
            colour = 6;
        }

        var qty = document.getElementById("qty");
        var price = document.getElementById("cost");
        var delivery_with_colombo = document.getElementById("dwc");
        var delivery_out_of_colombo = document.getElementById("doc");
        var description = document.getElementById("desc");
        var image = document.getElementById("imguploader");

        var form = new FormData();
        form.append("c", category.value);
        form.append("b", brand.value);
        form.append("m", model.value);
        form.append("t", title.value);
        form.append("co", condition);
        form.append("col", colour);
        form.append("qty", qty.value);
        form.append("p", price.value);
        form.append("dwc", delivery_with_colombo.value);
        form.append("doc", delivery_out_of_colombo.value);
        form.append("desc", description.value);
        form.append("img", image.files[0]);

        var r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var text = this.responseText;
                alert(text);
            }
        };

        r.open("POST", "addproductprocess.php", true);
        r.send(form);

    }

    function signout() {

        var r = new XMLHttpRequest();

        r.onreadystatechange = function() {
            if (r.readyState == 4) {

                var text = r.responseText;

                if (text == "Success") {
                    alert(text);
                    window.location = "home.php";
                } else {

                }

            }
        };

        r.open("GET", "signout.php", true);
        r.send();
    }

    function changeproductview() {
        var add = document.getElementById("addproductbox");
        var update = document.getElementById("updateproductbox");

        add.classList.toggle("d-none");
        update.classList.toggle("d-none");

    }


    function updateprofile() {

        var fname = document.getElementById("fn");
        var lname = document.getElementById("ln");
        var mobile = document.getElementById("mobile");
        var line1 = document.getElementById("line1");
        var line2 = document.getElementById("line2");
        var city = document.getElementById("city");
        var img = document.getElementById("profileimg");

        var form = new FormData();
        form.append("f", fname.value);
        form.append("l", lname.value);
        form.append("m", mobile.value);
        form.append("a1", line1.value);
        form.append("a2", line2.value);
        form.append("c", city.value);
        form.append("i", img.files[0]);

        var r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var text = this.responseText;
                alert(text);
                window.location = "userprofile.php";
            }
        };

        r.open("POST", "updateprofileprocess.php", true);
        r.send(form);

    }

    function changeimgprofile() {
        var image = document.getElementById("profileimg");
        var view = document.getElementById("p");

        image.onchange = function() {
            var file = this.files[0];
            var url = window.URL.createObjectURL(file);

            view.src = url;
        }
    }

    function changestatus(id) {

        var productid = id;
        var statuschange = document.getElementById("deactive");
        var statuslbel = document.getElementById("clabel" + productid);

        var r = new XMLHttpRequest();

        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var t = r.responseText;
                if (t == "Deactivated") {
                    statuslbel.innerHTML = "Make your product Activate";

                } else if (t == "Activated") {
                    statuslbel.innerHTML = "Make your product Deactivate";

                }
            }
        };

        r.open("GET", "changestatusprocess.php?p=" + productid, true);
        r.send();

    }

    function deletemodel(id) {

        var dm = document.getElementById("delmodel" + id);

        k = new bootstrap.Modal(dm);
        k.show();
    }

    function deleteproduct(id) {

        var productid = id;

        var r = new XMLHttpRequest();

        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var t = r.responseText;

                alert(t);
                var dm = document.getElementById("delmodel" + id);
                k = new bootstrap.Modal(dm);
                k.hide();
                window.location.reload();

            }
        };

        r.open("GET", "deleteproductprocess.php?id=" + productid, true);
        r.send();

    }

    function addfilters() {

        var search = document.getElementById("s");
        var pr = document.getElementById("pr");

        var age;
        if (document.getElementById("n").checked) {
            age = 1;
        } else if (document.getElementById("o").checked) {
            age = 2;
        } else {
            age = 0;
        }

        var qty;

        if (document.getElementById("l").checked) {
            qty = 1;
        } else if (document.getElementById("h").checked) {
            qty = 2;
        } else {
            qty = 0;
        }

        var condition;

        if (document.getElementById("b").checked) {
            condition = 1;
        } else if (document.getElementById("u").checked) {
            condition = 2;
        } else {
            condition = 0;
        }

        var form = new FormData();
        form.append("s", search.value);
        form.append("a", age);
        form.append("q", qty);
        form.append("c", condition);

        var r = new XMLHttpRequest();

        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var t = r.responseText;
                pr.innerHTML = t;

            }
        };

        r.open("POST", "filterprocess.php", true);
        r.send(form);

    }

    function searchforupdate() {

        var id = document.getElementById("searchforupdate").value;
        var title = document.getElementById("ti");
        var ca = document.getElementById("ca");
        var brand = document.getElementById("br");
        var model = document.getElementById("mo");
        var bn = document.getElementById("bn");
        var us = document.getElementById("us");
        var crl1 = document.getElementById("clr1");
        var crl2 = document.getElementById("clr2");
        var crl3 = document.getElementById("clr3");
        var crl4 = document.getElementById("clr4");
        var crl5 = document.getElementById("clr5");
        var crl6 = document.getElementById("clr6");
        var qty = document.getElementById("qty");
        var price = document.getElementById("cost");
        var dwc = document.getElementById("dwc");
        var doc = document.getElementById("doc");
        var desc = document.getElementById("desc");
        var img = document.getElementById("prev");

        var r = new XMLHttpRequest();

        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var t = r.responseText;
                var object = JSON.parse(t);
                // alert(object["title"]);

                title.value = object["title"];
                ca.value = object["category"];
                brand.value = object["brand"];
                model.value = object["model"];

                if (object["con"] == 1) {
                    bn.checked = true;

                } else if (object["con"] == 2) {
                    us.checked = true;

                }

                if (object["color"] == 1) {
                    crl1.checked = true;

                } else if (object["color"] == 2) {
                    crl2.checked = true;

                } else if (object["color"] == 3) {
                    crl3.checked = true;

                } else if (object["color"] == 4) {
                    crl4.checked = true;

                } else if (object["color"] == 5) {
                    crl5.checked = true;

                } else if (object["color"] == 6) {
                    crl6.checked = true;

                }

                qty.value = object["qty"];
                price.value = object["price"];
                dwc.value = object["dwc"];
                doc.value = object["doc"];
                desc.value = object["desc"];
                img.src = object["img"];


            }
        };

        r.open("GET", "searchtoupdateprocess.php?id=" + id, true);
        r.send();
    }

    function sendid(id) {

        var id = id;

        var r = new XMLHttpRequest();

        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var t = r.responseText;

                if (t == "success") {
                    window.location = "updateproduct.php";

                } else {
                    alert(t);
                }

            }

        };

        r.open("GET", "sendidprocess.php?id=" + id, true);
        r.send();

    }

    function loadmainimg(id) {

        var pid = id;

        var img = document.getElementById("pimg" + pid).src;
        var mainimg = document.getElementById("mainimg");

        mainimg.style.backgroundImage = "url(" + img + ")";

    }

    function qty_inc(qty) {
        var pqty = qty;
        var input = document.getElementById("qtyinput");

        if (input.value < pqty) {

            var newvalue = parseInt(input.value) + 1;

            input.value = newvalue.toString();

        } else {

            alert("Maximum quantitiy count has been achived");
        }

    }

    function gocart() {
        window.location = "cart.php";
    }


    function qty_dec() {
        var input = document.getElementById("qtyinput");

        if (input.value > 1) {

            var newvalue = parseInt(input.value) - 1;

            input.value = newvalue.toString();
        } else {
            alert("Minimum quantitiy count has been achived");
        }

    }

    function basicsearch() {

        var searchtext = document.getElementById("basicsearchtext").value;
        var searchselect = document.getElementById("basicsearhselect").value;
        var cardrow = document.getElementById("mainsearch");
        var oldrow = document.getElementById("oldrow");
        var oldrow2 = document.getElementById("oldrow2");

        var r = new XMLHttpRequest();

        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var t = r.responseText;
                // alert(t);
                cardrow.innerHTML = t;
                oldrow.classList = "d-none";
                oldrow2.classList = "d-none";

            }
        };

        r.open("GET", "basicsearchprocess.php?t=" + searchtext + "&s=" + searchselect, true);
        r.send();

    }

    function addtowatchlist(id) {

        var pid = id;

        var r = new XMLHttpRequest();

        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var t = r.responseText;

                if (t == "success") {
                    alert(t);
                    window.location = "watchlist.php";
                }

            }
        }

        r.open("GET", "watchlistprocess.php?id=" + pid, true);
        r.send();

    }

    function removewatchlist(id) {

        var pid = id;

        var r = new XMLHttpRequest();

        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var t = r.responseText;
                if (t == "success") {
                    alert(t);
                    window.location = "watchlist.php";
                }

            }
        }

        r.open("GET", "removewatchlistprocess.php?id=" + pid, true);
        r.send();

    }

    function addtocart(id) {

        var qtytext = document.getElementById("qtytext" + id).value;
        var pid = id;

        // alert(qtytext);
        // alert(pid);

        var r = new XMLHttpRequest();

        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var t = r.responseText;
                if (t == "This product added in your cart") {
                    alert(t);
                    window.location = "cart.php";
                } else {
                    alert(t);
                }

            }
        };

        r.open("GET", "addcartprocess.php?id=" + pid + "&qty=" + qtytext, true);
        r.send();
    }

    function deletecart(id) {
        var cid = id;
        var r = new XMLHttpRequest();

        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var t = r.responseText;
                alert(t);
                window.location = "cart.php";
            }
        };

        r.open("GET", "deletecartprocess.php?id=" + cid, true);
        r.send();
    }

    function updatepro(id) {

        var pid = id;
        var title = document.getElementById("ti");
        var qty = document.getElementById("qty");
        var delivery_with_colombo = document.getElementById("dwc");
        var delivery_out_of_colombo = document.getElementById("doc");
        var description = document.getElementById("desc");
        var image = document.getElementById("imguploader");

        var form = new FormData();
        form.append("id", pid);
        form.append("t", title.value);
        form.append("qty", qty.value);
        form.append("dwc", delivery_with_colombo.value);
        form.append("doc", delivery_out_of_colombo.value);
        form.append("desc", description.value);
        form.append("img", image.files[0]);

        var r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var text = this.responseText;
                alert(text);
            }
        };

        r.open("POST", "updateproductprocess.php", true);
        r.send(form);

    }

    function paynow(id) {

        var qty = document.getElementById("qtyinput").value;
        var r = new XMLHttpRequest();

        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var t = r.responseText;
                var obj = JSON.parse(t);

                var mail = obj["email"];
                var amount = obj["amount"];

                if (t == "1") {

                    alert("Pleasse Sign in first !");
                    window.location = "index.php";

                } else if (t == "2") {

                    alert("Please update your profile first !");
                    window.location = "userprofile.php";

                } else {

                    // Called when user completed the payment. It can be a successful payment or failure
                    payhere.onCompleted = function onCompleted(orderId) {
                        console.log("Payment completed. OrderID:" + orderId);

                        saveinvoice(orderId, id, mail, amount, qty);

                        //Note: validate the payment and show success or failure page to the customer
                    };

                    // Called when user closes the payment without completing
                    payhere.onDismissed = function onDismissed() {
                        //Note: Prompt user to pay again or show an error page
                        console.log("Payment dismissed");
                    };

                    // Called when error happens when initializing payment such as invalid parameters
                    payhere.onError = function onError(error) {
                        // Note: show an error page
                        console.log("Error:" + error);
                    };

                    // Put the payment variables here
                    var payment = {
                        "sandbox": true,
                        "merchant_id": "1218542", // Replace your Merchant ID
                        "return_url": "http://localhost/eshop/singleproductview.php?id=" + id, // Important
                        "cancel_url": "http://localhost/eshop/singleproductview.php?id=" + id, // Important
                        "notify_url": "http://sample.com/notify",
                        "order_id": obj["id"],
                        "items": obj["item"],
                        "amount": obj["amount"],
                        "currency": "LKR",
                        "first_name": obj["fname"],
                        "last_name": obj["lname"],
                        "email": obj["email"],
                        "phone": obj["mobile"],
                        "address": obj["address"],
                        "city": obj["city"],
                        "country": "Sri Lanka",
                        "delivery_address": obj["address"],
                        "delivery_city": obj["city"],
                        "delivery_country": "Sri Lanka",
                        "custom_1": "",
                        "custom_2": ""
                    };

                    // Show the payhere.js popup, when "PayHere Pay" is clicked

                    payhere.startPayment(payment);


                }

            }
        };

        r.open("GET", "buynowprocess.php?id=" + id + "&qty=" + qty, true);
        r.send();

    }

    function saveinvoice(orderId, id, mail, amount, qty) {

        var orderid = orderId;
        var pid = id;
        var email = mail;
        var total = amount;
        var qty = qty;

        var form = new FormData();
        form.append("oid", orderid);
        form.append("pid", pid);
        form.append("email", email);
        form.append("total", total);
        form.append("qty", qty);

        var r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var text = this.responseText;
                if (text == "success") {

                    window.location = "invoice.php?id=" + orderId;

                }
            }
        };

        r.open("POST", "addinvoiceprocess.php", true);
        r.send(form);


    }

    function detailesmodal(id) {
        alert(id);
    }

    function printDiv() {

        var restorepage = document.body.innerHTML;
        var page = document.getElementById("GFG").innerHTML;
        document.body.innerHTML = page;
        window.print();
        document.body.innerHTML = restorepage;

    }

    function addfeedback(id) {

        var feedbackmodal = document.getElementById("feedbackmodal" + id);
        k = new bootstrap.Modal(feedbackmodal);

        k.show();

    }

    function savefeedback(id) {

        var pid = id;
        var feedtext = document.getElementById("feedtext" + id).value;

        var form = new FormData();
        form.append("pid", pid);
        form.append("feed", feedtext);

        var r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var text = this.responseText;
                if (text == "1") {
                    alert("You feddback saved ");
                    k.hide();
                }
            }
        };

        r.open("POST", "addfeedbackprocess.php", true);
        r.send(form);

    }

    function adminverification() {

        var e = document.getElementById("e").value;

        var form = new FormData();
        form.append("e", e);

        var r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var text = this.responseText;
                if (text == "success") {
                    alert("verification email sent . please check your email");
                    var m = document.getElementById("verify");
                    bm = new bootstrap.Modal(m);
                    bm.show();

                } else {
                    alert(text);

                }
            }
        };

        r.open("POST", "adminsigninprocess.php?e=" + e, true);
        r.send(form);

    }


    function verify() {

        var v = document.getElementById("v").value;
        var e = document.getElementById("e").value;

        var form = new FormData();
        form.append("v", v);
        form.append("e", e);

        var r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var text = r.responseText;
                if (text == "1") {
                    alert("admin Sign in Success");

                    bm.hide();
                    window.location = "adminpanel.php";

                } else {
                    alert(text);
                }

            }
        };

        r.open("POST", "adminverifyprocess.php", true);
        r.send(form);

    }

    function blockusers(email) {

        var mail = email;

        var blockbtn = document.getElementById("blockbtn" + email);

        var form = new FormData();
        form.append("e", mail);

        var r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var text = r.responseText;
                if (text == "success1") {
                    blockbtn.classList = "btn btn-success";
                    blockbtn.innerHTML = "unblock";
                } else if (text == "success2") {
                    blockbtn.classList = "btn btn-danger";
                    blockbtn.innerHTML = "block";
                }
            }

        };

        r.open("POST", "userblockprocess.php", true);
        r.send(form);

    }

    function blockproducts(id) {

        var id = id;

        var blockbtn = document.getElementById("blockbtn1" + id);

        var form = new FormData();
        form.append("e", id);

        var r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var text = r.responseText;
                if (text == "success1") {
                    blockbtn.classList = "btn btn-success";
                    blockbtn.innerHTML = "unblock";
                } else if (text == "success2") {
                    blockbtn.classList = "btn btn-danger";
                    blockbtn.innerHTML = "block";
                }
            }

        };

        r.open("POST", "productblockprocess.php", true);
        r.send(form);

    }

    function searchusers() {

        var t = document.getElementById("searchtxt").value;
        var ou = document.getElementById("olduser");
        var nu = document.getElementById("newuser");

        var form = new FormData();
        form.append("t", t);

        var r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var text = r.responseText;
                ou.classList = "d-none";
                nu.innerHTML = text;
            }

        };

        r.open("POST", "userssearchprocess.php", true);
        r.send(form);

    }

    function searchproducts() {

        var t = document.getElementById("tt").value;
        var np = document.getElementById("newproduct");
        var op = document.getElementById("oldproduct");

        var form = new FormData();
        form.append("t", t);

        var r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var text = r.responseText;
                op.classList = "d-none";
                np.innerHTML = text;
            }

        };

        r.open("POST", "productsearchprocess.php", true);
        r.send(form);

    }

    function advancesearch() {

        var viewresults = document.getElementById("viewresults");

        var keyboard = document.getElementById("k").value;
        var category = document.getElementById("c").value;
        var brand = document.getElementById("b").value;
        var model = document.getElementById("m").value;
        var condition = document.getElementById("con").value;
        var color = document.getElementById("clr").value;
        var pricefrom = document.getElementById("pf").value;
        var priceto = document.getElementById("pt").value;

        var form = new FormData();
        form.append("k", keyboard);
        form.append("c", category);
        form.append("b", brand);
        form.append("m", model);
        form.append("con", condition);
        form.append("clr", color);
        form.append("pf", pricefrom);
        form.append("pt", priceto);

        var r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var text = r.responseText;

                // alert(text);
                viewresults.innerHTML = text;
            }

        };

        r.open("POST", "advancedsearchprocess.php", true);
        r.send(form);

    }

    function dailyselling() {

        var fromdate = document.getElementById("fromdate").value;
        var todate = document.getElementById("todate").value;
        var link = document.getElementById("historylink");

        link.href = "sellinghistory.php?f=" + fromdate + "&t=" + todate;

    }

    function viewmsgmodal(mail) {

        var modal = document.getElementById("msgmodal" + mail);
        k = new bootstrap.Modal(modal);
        k.show();


    }

    function addnewmodal() {
        var modal = document.getElementById("addnewmodal");

        k = new bootstrap.Modal(modal);
        k.show();

    }

    function savecategory() {

        var textcategory = document.getElementById("textcategory").value;

        var r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var text = r.responseText;
                if (text == "success") {
                    k.hide();
                    alert("Category Saved Successfully");
                    window.location.reload();

                } else {
                    alert(text);
                }
            }

        };

        r.open("GET", "addcategoryprocess.php?c=" + textcategory, true);
        r.send();

    }

    function singlemodal(id) {
        var modal = document.getElementById("singleproductview" + id);

        k = new bootstrap.Modal(modal);
        k.show();
    }

    function sendmessage(mail) {

        var email = mail;
        var msgtxt = document.getElementById("msgtxt").value;

        var f = new FormData();
        f.append("e", email);
        f.append("t", msgtxt);

        var r = new XMLHttpRequest();

        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var t = r.responseText;

                if (t == "success") {

                    alert("Message Sent Successfully");

                } else {
                    alert("t");
                }
            }
        }

        r.open("POST", "sendmessageprocess.php", true);
        r.send(f);

    }

    function refresher(email) {

        setInterval(refreshmsgare(email), 500);
        setInterval(refreshrecentarea, 500);
    }

    // refres msg view area

    function refreshmsgare(mail) {

        var chatrow = document.getElementById("chatrow");

        var f = new FormData();
        f.append("e", mail);

        var r = new XMLHttpRequest();

        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var t = r.responseText;

                chatrow.innerHTML = t;

            }
        }

        r.open("POST", "refreshmsgareaprocess.php", true);
        r.send(f);

    }

    // refreshrecentarea

    function refreshrecentarea() {

        var rcv = document.getElementById("rcv");

        var r = new XMLHttpRequest();

        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var t = r.responseText;
                rcv.innerHTML = t;
            }
        }

        r.open("POST", "refreshrecentareaprocess.php", true);
        r.send();

    }