<template>
<Layout>
    <TopBar :breadcrumbs="breadcrumbs" />
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Creacion de Articulo</h3><br>
                    </div>
                    <hr class="horizontal dark">
                    <div class="car-body" v-if="this.$permissions(this.$page.props.auth.user, 'compras-crear-articulo')">
                        <div class="row">
                            <div class="col-12 ">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>id articulo</th>
                                            <th>nombre articulo</th>
                                            <th>color</th>
                                            <th>medida</th>
                                            <th>CBM/volumen</th>
                                            <th>relleno/gramaje</th>
                                            <th>construccion</th>
                                            <th>med.bolsa</th>
                                            <th>med.caja</th>
                                            <th>piezas x caja</th>
                                            <th>marca</th>
                                            <th>cliente</th>
                                            <th>tarifa</th>
                                            <th>gama</th>
                                            <th>familia</th>
                                            <th>Inner</th>
                                            <th>peso</th>
                                            <th>umv</th>
                                            <th>Eti.textil</th>
                                            <th>Eti.Hangtag</th>
                                            <th>Pegatinas</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <input v-model="idArticle" class="form-control rounded" type="text" placeholder="Id del articulo" required @keydown.enter.prevent="searchArticle">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <input v-model="nameArticle" class="form-control rounded" type="text"  placeholder="nombre del articulo" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <input v-model="colorArticle" class="form-control rounded" type="text" placeholder="color del articulo" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <input v-model="measureArticle" class="form-control rounded" type="text" placeholder="medida del articulo" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <input v-model="cbmArticle" class="form-control rounded" type="number" placeholder="cbm del articulo" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <input v-model="rellenoArticle" class="form-control rounded" type="text" placeholder="relleno del articulo" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <input v-model="buildingArticle" class="form-control rounded" type="text" placeholder="construccion del articulo" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <input v-model="bagMeasureArticle" class="form-control rounded" type="text" placeholder="medidas bolsa del articulo" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <input v-model="boxMeasureArticle" class="form-control rounded" type="text" placeholder="medidas caja del articulo" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <input v-model="piecesBoxArticle" class="form-control rounded" type="text" placeholder="piezas x caja del articulo" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <v-select class="form-control rounded" v-model="brandSelect" label="nameBrand" required :options="brand" placeholder="Seleccione la marca">
                                                            </v-select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <v-select class="form-control rounded" v-model="clientSelect" :options="clients" required label="nameGroupCli" placeholder="Seleccione el cliente">
                                                            </v-select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <v-select class="form-control rounded" v-model="rateSelect" :options="rates" required label="nameRate" placeholder="Seleccione la tarifa">
                                                            </v-select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <v-select class="form-control rounded" v-model="gamaSelect" :options="gama" required label="nameGama" placeholder="Seleccione la gama">
                                                            </v-select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <v-select class="form-control rounded" v-model="familySelect" :options="families" required label="nameFamily" placeholder="Seleccione la familia">
                                                            </v-select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <input v-model="innerArticle" class="form-control rounded" type="text" placeholder="inner" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <input v-model="pesoArticle" class="form-control rounded" type="text" placeholder="peso" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <input v-model="umvArticle" class="form-control rounded" type="text" placeholder="umv" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <select v-model="textilArticle" class="form-select rounded" placeholder="¿lleva eti.textil?" required>
                                                                <option disabled selected>Elige la etiqueta</option>
                                                                <option value="si,">Si</option>
                                                                <option value="no">No</option>
                                                            </select></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <select v-model="hangtagArticle" class="form-select rounded" placeholder="¿lleva eti.hangtag?" required>
                                                                <option disabled selected>Elige la etiqueta</option>
                                                                <option value="si,">Si</option>
                                                                <option value="no">No</option>
                                                            </select></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <select v-model="stickerArticle" class="form-select rounded" placeholder="¿llega pegatina?" required>
                                                                <option disabled selected>Elige la etiqueta</option>
                                                                <option value="si,">Si</option>
                                                                <option value="no">No</option>
                                                            </select></div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <template v-if="this.dataRepeat.length > 0" v-for="(item,index) in this.dataRepeat" :key="item.idArticle">
                                            <tr >
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="item.idArticle"  class="form-control rounded" type="text" placeholder="Id del articulo" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="item.nameArticle" class="form-control rounded" type="text" placeholder="Nombre del articulo" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="item.colorArticle" class="form-control rounded" type="text" placeholder="Id de la familia" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="item.measureArticle" class="form-control rounded" type="text" placeholder="Id de la familia" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="item.gramajeArticle" class="form-control rounded" type="number" placeholder="Id de la familia" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="item.rellenoArticle" class="form-control rounded" type="text" placeholder="Id de la familia" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="item.buildingArticle" class="form-control rounded" type="text" placeholder="Id de la familia" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="item.bagMeasureArticle" class="form-control rounded" type="text" placeholder="Id de la familia" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="item.boxMeasureArticle" class="form-control rounded" type="text" placeholder="Id de la familia" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="item.piecesBoxArticle" class="form-control rounded" type="text" placeholder="Id de la familia" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="item.brandSelect.nameBrand" required class="form-control rounded" label="nameBrand" placeholder="Seleccione el cliente">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="item.clientSelect.nameGroupCli" required class="form-control rounded" label="nameGroupCli" placeholder="Seleccione el cliente">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="item.rateSelect.nameRate" required class="form-control rounded" label="nameRate" placeholder="Seleccione la tarifa">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="item.gamaSelect.nameGama" required class="form-control rounded" label="nameGama" placeholder="Seleccione la gama">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="item.familySelect.nameFamily" required class="form-control rounded" label="nameFamily" placeholder="Seleccione la familia">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="item.innerArticle" class="form-control rounded" type="text" placeholder="inner" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="item.pesoArticle" class="form-control rounded" type="text" placeholder="peso" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="item.umvArticle" class="form-control rounded" type="text" placeholder="umv" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <select class="form-select rounded" v-model="item.textilArticle" placeholder="¿lleva eti.textil?" required>
                                                                    <option selected>Elige la etiqueta</option>
                                                                    <option value="si,">Si</option>
                                                                    <option value="no">No</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <select class="form-select rounded" v-model="item.hangtagArticle" placeholder="¿lleva eti.hangtag?" required>
                                                                    <option selected>Elige la etiqueta</option>
                                                                    <option value="si,">Si</option>
                                                                    <option value="no">No</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <select class="form-select rounded" v-model="item.stickerArticle" placeholder="¿lleva pegatina?" required>
                                                                    <option selected>Elige la etiqueta</option>
                                                                    <option value="si,">Si</option>
                                                                    <option value="no">No</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr v-if="translateData[index]">
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="translateData[index].idArticle"  class="form-control rounded text-info" type="text" placeholder="Id del articulo" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="translateData[index].nameArticle"  class="form-control rounded text-info" type="text" placeholder="nombre del articulo" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="translateData[index].colorArticle"  class="form-control rounded text-info" type="text" placeholder="color del articulo" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="translateData[index].measureArticle"  class="form-control rounded text-info" type="text" placeholder="medida del articulo" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="translateData[index].gramajeArticle"  class="form-control rounded text-info" type="text" placeholder="gramaje del articulo" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="translateData[index].rellenoArticle"  class="form-control rounded text-info" type="text" placeholder="relleno del articulo" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="translateData[index].buildingArticle"  class="form-control rounded text-info" type="text" placeholder="construccion" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="translateData[index].bagMeasureArticle"  class="form-control rounded text-info" type="text" placeholder="med.bolsa" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="translateData[index].boxMeasureArticle"  class="form-control rounded text-info" type="text" placeholder="med.caja" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="translateData[index].piecesBoxArticle"  class="form-control rounded text-info" type="text" placeholder="piezas del articulo" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="translateData[index].brandSelect.nameBrand" class="form-control rounded text-info" label="nameBrand" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="translateData[index].clientSelect.nameGroupCli" class="form-control rounded text-info" label="nameGroupCli" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="translateData[index].rateSelect.nameRate" class="form-control rounded text-info" label="nameRate" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="translateData[index].gamaSelect.nameGama" class="form-control rounded text-info" label="nameGama" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="translateData[index].familySelect.nameFamily" class="form-control rounded text-info" label="nameFamily" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="translateData[index].innerArticle"  class="form-control rounded text-info" type="text" placeholder="inner del articulo" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="translateData[index].pesoArticle"  class="form-control rounded text-info" type="text" placeholder="peso del articulo" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input v-model="translateData[index].umvArticle"  class="form-control rounded text-info" type="text" placeholder="umv del articulo" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <select class="form-select rounded text-info" v-model="translateData[index].textilArticle" placeholder="¿lleva eti.textil?" required>
                                                                    <option selected>Select Label</option>
                                                                    <option value="Yes.">Yes</option>
                                                                    <option value="No.">No</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <select class="form-select rounded text-info" v-model="translateData[index].hangtagArticle" placeholder="¿lleva hangtag?" required>
                                                                    <option selected>Select Label</option>
                                                                    <option value="Yes.">Yes</option>
                                                                    <option value="No.">No</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <select class="form-select rounded text-info" v-model="translateData[index].stickerArticle" placeholder="¿lleva pegatina?" required>
                                                                    <option selected>Select Label</option>
                                                                    <option value="Yes.">Yes</option>
                                                                    <option value="No.">No</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>
                                        <tr>
                                            <div class="row">
                                                <div class="col-sm">
                                                    <div class="input-group">
                                                        <label class="form-label">Nº veces a crear</label>
                                                        <div class="input-group">
                                                            <input class="form-control rounded" type="number" v-model="numberCreated" placeholder="nº veces a crear" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary btn-sm" @click="this.addData">Crear</button>
                                    <Link class="btn btn-warning btn-sm" >Cancelar</Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</Layout>
</template>
<script>
import {Link} from '@inertiajs/inertia-vue3'
import Layout from '../../../../Layouts/Layout.vue';
import TopBar from '../../../../Layouts/Navbar/Topbar.vue';
import {toast} from "vue3-toastify";
const notify = ( message, type="warning",autoClose = true) =>
    toast(message, {
        type: type,
        theme: "auto",
        autoClose: autoClose,
    });

export default {
    name: "Index CreateArticle",
    components: {
        Layout,
        TopBar,
        Link,
    },
    props: {
        clients: Array,
        rates: Array,
        families: Array,
        gama: Array,
        brand: Array
    },
    data() {
        return {
            breadcrumbs: {
                title: 'Crear Articulo',
                breadcrumb: {
                    title: 'Compras',
                    url: null
                }
            },
            idArticle: '',
            nameArticle: '',
            colorArticle: '',
            measureArticle: '',
            cbmArticle: '',
            rellenoArticle: '',
            buildingArticle: '',
            bagMeasureArticle: '',
            boxMeasureArticle: '',
            piecesBoxArticle: '',
            clientSelect:'',
            rateSelect:'',
            familySelect:'',
            gamaSelect:'',
            brandSelect:'',
            innerArticle: '',
            pesoArticle: '',
            umvArticle: '',
            textilArticle: '',
            hangtagArticle: '',
            stickerArticle: '',
            numberCreated: '',
            originData: [],
            dataRepeat: [],
            translateData: [],
            translateFamilies: []
        }
    },
    methods: {
        searchArticle(){
            toast.info('Buscando Articulo, espere un momento por favor',{autoClose:1000});
            const data = {
                idArticle: this.idArticle
            }
            axios.post(route('createArticle.search.article'), data)
                .then(response => {
                    if (response.data.length === 0) {
                        toast.warning('Articulo no encontrado');
                        return
                    }
                    toast.success('Articulo encontrado, listo para clonar');
                    this.nameArticle = response.data[0].nameArticle;
                    this.colorArticle = response.data[0].colorArticle;
                    this.measureArticle = response.data[0].measureArticle;
                    this.rellenoArticle = response.data[0].rellenoArticle;
                    this.buildingArticle = response.data[0].buildingArticle;
                    this.bagMeasureArticle = response.data[0].bagMeasureArticle;
                    this.boxMeasureArticle = response.data[0].boxMeasureArticle;
                    this.piecesBoxArticle = response.data[0].piecesBoxArticle;
                    this.cbmArticle = response.data[0].cbmArticle;
                    this.gamaSelect = this.gama.find(gama => gama.idGama === parseInt(response.data[0].gamaSelect));
                    this.brandSelect = this.brand.find(brand => brand.idBrand === (response.data[0].brandSelect));
                    this.familySelect = this.families.find(family => family.idFamily === parseInt(response.data[0].familySelect));
                    this.rateSelect = this.rates.find(rate => rate.idRate === (response.data[0].rateSelect));
                    this.pesoArticle = response.data[0].pesoArticle;

                })
        },
          async addData() {
              if (this.numberCreated === '' || this.numberCreated < 0 || this.numberCreated === 0) {
                  toast.warning('No se puede crear un articulo sin nº de veces a crear');
                  return
              }
              if (this.nameArticle === '') {
                  toast.warning('No se puede crear un articulo sin datos');
                  return
              }
              toast.info('Clonando Articulos... y traduciendolos');

              const translateName = await this.callApi(this.nameArticle);
              const translateColor = await this.callApi(this.colorArticle);
              const translateRelleno = await this.callApi(this.rellenoArticle);
              const translateBuilding = await this.callApi(this.buildingArticle);
              const translateTextil = await this.callApi(this.textilArticle);
              const translateHangtag = await this.callApi(this.hangtagArticle);
              const translateSticker = await this.callApi(this.stickerArticle);
              this.translateData.push({
                  idArticle: this.idArticle,
                  nameArticle: translateName,
                  colorArticle: translateColor,
                  measureArticle: this.measureArticle,
                  cbmArticle: this.cbmArticle,
                  rellenoArticle: translateRelleno,
                  buildingArticle: translateBuilding,
                  bagMeasureArticle: this.bagMeasureArticle,
                  boxMeasureArticle: this.boxMeasureArticle,
                  piecesBoxArticle: this.piecesBoxArticle,
                  clientSelect: this.clientSelect,
                  rateSelect: this.rateSelect,
                  familySelect: this.familySelect,
                  gamaSelect: this.gamaSelect,
                  brandSelect: this.brandSelect,
                  innerArticle: this.innerArticle,
                  pesoArticle: this.pesoArticle,
                  umvArticle: this.umvArticle,
                  textilArticle: translateTextil,
                  hangtagArticle: translateHangtag,
                  stickerArticle: translateSticker,
              });
              for (let i = 0; i < this.numberCreated; i++) {
                  const newArticle = {
                      idArticle: this.idArticle,
                      nameArticle: this.nameArticle,
                      colorArticle: this.colorArticle,
                      measureArticle: this.measureArticle,
                      cmbArticle: this.cmbArticle,
                      rellenoArticle: this.rellenoArticle,
                      buildingArticle: this.buildingArticle,
                      bagMeasureArticle: this.bagMeasureArticle,
                      boxMeasureArticle: this.boxMeasureArticle,
                      piecesBoxArticle: this.piecesBoxArticle,
                      clientSelect: this.clientSelect,
                      rateSelect: this.rateSelect,
                      familySelect: this.familySelect,
                      gamaSelect: this.gamaSelect,
                      brandSelect: this.brandSelect,
                      innerArticle: this.innerArticle,
                      pesoArticle: this.pesoArticle,
                      umvArticle: this.umvArticle,
                      textilArticle: this.textilArticle,
                      hangtagArticle: this.hangtagArticle,
                      stickerArticle: this.stickerArticle,
                  }
                  const translateNewArticle ={
                      idArticle: this.idArticle,
                      nameArticle: translateName,
                      colorArticle: translateColor,
                      measureArticle: this.measureArticle,
                      cbmArticle: this.cbmArticle,
                      rellenoArticle: translateRelleno,
                      buildingArticle: translateBuilding,
                      bagMeasureArticle: this.bagMeasureArticle,
                      boxMeasureArticle: this.boxMeasureArticle,
                      piecesBoxArticle: this.piecesBoxArticle,
                      clientSelect: this.clientSelect,
                      rateSelect: this.rateSelect,
                      familySelect: this.familySelect,
                      gamaSelect: this.gamaSelect,
                      brandSelect: this.brandSelect,
                      innerArticle: this.innerArticle,
                      pesoArticle: this.pesoArticle,
                      umvArticle: this.umvArticle,
                      textilArticle: translateTextil,
                      hangtagArticle: translateHangtag,
                      stickerArticle: translateSticker,
                  }
                  this.dataRepeat.push(newArticle)
                  this.translateData.push(translateNewArticle)
              }
          },
        async callApi(option) {
            let api = 'https://api.mymemory.translated.net/get?q=' + option + '&langpair=es|en';
            return fetch(api).then(res => res.json()).then(res => {
                return res.responseData.translatedText;
            })
        }
    }
}
</script>
<style scoped>

</style>
