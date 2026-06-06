<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CaseSeeder extends Seeder
{
    public function run(): void
    {
        $cases = [
            [
                'slug' => 'suspensao-execucoes-preservacao-ativos',
                'title' => 'Suspensão de Execuções e Preservação de Ativos',
                'description' => '<p>Produtor da região Norte de MT, com mais de 2.000 hectares de área produtiva e dívida superior a R\$ 15 milhões, conseguiu suspender execuções judiciais e preservar seus ativos através de estratégia jurídica especializada.</p>',
                'image' => 'img/case/case1.png',
                'context' => '<p>Um produtor rural da região Norte de Mato Grosso enfrentava uma <strong>situação crítica</strong>: com mais de 2.000 hectares de área produtiva e dívidas superiores a R\$ 15 milhões, estava sob pressão de múltiplas execuções judiciais que ameaçavam não apenas sua operação, mas também o patrimônio familiar construído ao longo de décadas. As execuções em andamento incluíam débitos com:</p>
                <ul>
                <li>fornecedores de insumos,</li>
                <li>instituições financeiras e</li>
                <li>contratos de comercialização de grãos.</li>
                </ul>
                <p>O cenário se agravava pela queda nos preços das commodities e problemas climáticos que afetaram as últimas safras, reduzindo <em>significativamente</em> a capacidade de pagamento.</p>',
                'date' => '2025-10-01',
                'categoria_id' => 1, // Renegociação
                'results' => json_encode([
                    'valor_da_divida' => 'R\$ 15 milhões',
                    'area' => '2.000 hectares',
                    'regiao' => 'Norte de MT',
                    'tempo_de_solucao' => '90 dias'
                ]),
                'status' => 'published',
                'featured' => true,
            ],
            [
                'slug' => 'recuperacao-judicial-cooperativa-agricola',
                'title' => 'Recuperação Judicial de Cooperativa Agrícola',
                'description' => '<p>Cooperativa com mais de 500 associados e dívidas de R\$ 25 milhões obteve aprovação do plano de recuperação judicial, mantendo operações e preservando empregos.</p>',
                'image' => 'img/case/case2.png',
                'context' => '<p>Uma cooperativa agrícola tradicional da região Centro-Oeste, com mais de 30 anos de atuação e 500 cooperados, enfrentava grave crise financeira decorrente de:</p>
                <ul>
                <li>Quebra de safra por fatores climáticos</li>
                <li>Queda abrupta nos preços das commodities</li>
                <li>Inadimplência de grandes cooperados</li>
                <li>Investimentos em expansão mal dimensionados</li>
                </ul>
                <p>A situação exigia uma solução que preservasse não apenas a cooperativa, mas também os interesses de centenas de famílias dependentes da organização.</p>',
                'date' => '2025-09-15',
                'categoria_id' => 2, // Recuperação Judicial
                'results' => json_encode([
                    'valor_da_divida' => 'R\$ 25 milhões',
                    'cooperados' => '500 associados',
                    'aprovacao_plano' => '85% dos credores',
                    'prazo_pagamento' => '5 anos'
                ]),
                'status' => 'published',
                'featured' => true,
            ],
            [
                'slug' => 'defesa-execucao-contratos-soja',
                'title' => 'Defesa em Execução de Contratos de Soja',
                'description' => '<p>Produtor conseguiu suspender execução de R\$ 8 milhões por descumprimento de contrato de soja, através de contestação técnica sobre qualidade do produto.</p>',
                'image' => 'img/case/case3.png',
                'context' => '<p>Um grande produtor de soja do Mato Grosso do Sul foi executado por uma trading internacional no valor de R\$ 8 milhões, sob alegação de descumprimento de contrato de entrega de soja. O caso envolvia:</p>
                <ul>
                <li>Questionamentos sobre padrões de qualidade</li>
                <li>Divergências em laudos técnicos</li>
                <li>Problemas logísticos na entrega</li>
                <li>Interpretação de cláusulas contratuais</li>
                </ul>
                <p>A defesa técnica especializada foi fundamental para demonstrar as irregularidades do processo executivo.</p>',
                'date' => '2025-08-20',
                'categoria_id' => 3, // Execução
                'results' => json_encode([
                    'valor_execucao' => 'R\$ 8 milhões',
                    'produto' => 'Soja',
                    'resultado' => 'Execução suspensa',
                    'tempo_defesa' => '60 dias'
                ]),
                'status' => 'published',
                'featured' => false,
            ],
            [
                'slug' => 'renegociacao-dividas-tributarias-rurais',
                'title' => 'Renegociação de Dívidas Tributárias Rurais',
                'description' => '<p>Fazenda com débitos de R\$ 12 milhões em impostos conseguiu adesão ao REFIS Rural com desconto de 70% em multas e juros.</p>',
                'image' => 'img/case/case4.png',
                'context' => '<p>Uma propriedade rural familiar de grande porte acumulou ao longo dos anos débitos tributários significativos, principalmente relacionados a:</p>
                <ul>
                <li>ITR (Imposto Territorial Rural)</li>
                <li>INCRA (contribuições)</li>
                <li>INSS sobre produção rural</li>
                <li>Multas e juros de mora</li>
                </ul>
                <p>A situação comprometia a capacidade de investimento e crescimento da propriedade, exigindo uma estratégia de regularização fiscal eficiente.</p>',
                'date' => '2025-07-10',
                'categoria_id' => 6, // Direito Tributário Rural
                'results' => json_encode([
                    'valor_original' => 'R\$ 12 milhões',
                    'desconto_obtido' => '70% em multas e juros',
                    'valor_final' => 'R\$ 4,2 milhões',
                    'prazo_pagamento' => '120 meses'
                ]),
                'status' => 'published',
                'featured' => false,
            ],
            [
                'slug' => 'licenciamento-ambiental-expansao-agricola',
                'title' => 'Licenciamento Ambiental para Expansão Agrícola',
                'description' => '<p>Obtenção de licenciamento ambiental para expansão de 1.500 hectares, superando impasses com órgãos ambientais e comunidades locais.</p>',
                'image' => 'img/case/case5.png',
                'context' => '<p>Um grupo empresarial do agronegócio planejava expandir suas operações em 1.500 hectares em área de transição Cerrado-Amazônia, enfrentando:</p>
                <ul>
                <li>Complexidade da legislação ambiental</li>
                <li>Exigências de compensação ambiental</li>
                <li>Pressão de ONGs ambientais</li>
                <li>Necessidade de consulta às comunidades tradicionais</li>
                </ul>
                <p>O processo exigiu estratégia jurídica integrada com aspectos técnicos, ambientais e sociais.</p>',
                'date' => '2025-06-05',
                'categoria_id' => 7, // Questões Ambientais
                'results' => json_encode([
                    'area_licenciada' => '1.500 hectares',
                    'tempo_processo' => '18 meses',
                    'compensacao_ambiental' => '300 hectares preservados',
                    'investimento_social' => 'R\$ 2 milhões'
                ]),
                'status' => 'published',
                'featured' => true,
            ]
        ];

        foreach ($cases as $case) {
            DB::table('cases')->insert([
                'slug' => $case['slug'],
                'title' => $case['title'],
                'description' => $case['description'],
                'image' => $case['image'],
                'context' => $case['context'],
                'date' => $case['date'],
                'categoria_id' => $case['categoria_id'],
                'results' => $case['results'],
                'status' => $case['status'],
                'featured' => $case['featured'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
